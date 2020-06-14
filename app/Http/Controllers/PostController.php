<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Category;
use App\Post;
use App\PostView;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Session;
use Image;

class PostController extends Controller
{
    //
    public function create(Request $request){


        $categories = BlogCategory::all();
        $tags = Tag::all();

        if($request->isMethod('post')){

            //dd($request);
            $data = $request->except('name');
            $post = new Post;
            //Title
            $post->title = $request->title;
            //Slug
            $post->publish_date = new Carbon;
            $slug = $this->createSlug($request->title);
            $post->slug = $slug;

            //Category
            if($request->category_id == "Choose Category")
            {
                Session::flash('failure','Please Select A Category To Proceed!');
                return redirect()->back();
            }else{
                $post->category_id = $request->category_id;
            }




            //Body
            $post->body = $request->body;
            $dom = new \DOMDocument();
            $dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach($images as $img){
                $src = $img->getAttribute('src');

                // if the img source is 'data-url'
                if(preg_match('/data:image/', $src)){
                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                    // Generating a random filename
                    $filename = "mohvisuals".uniqid();
                    $filepath = "uploads/$filename.$mimetype";
                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                        // resize if required
                        /* ->resize(300, 200) */
                        ->encode($mimetype, 100)  // encode file to the specified mimetype
                        ->save(public_path($filepath));
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);

                } // <!--endif
            } // <!-

            $post->body = $dom->saveHTML();


            //authors
            if(isset($request->author)){
                $post->author = $request->author;
                $post->author_slug = Str::slug($post->author,'-');
            }else{
                $post->author = "";
                $post->author_slug = "";
            }

            //User ID
            $post->user_id = Auth::user()->id;

            //Keywords
            if(isset($request->keywords)){
                $post->keywords = $request->keywords;
            }else{
                $post->keywords = "";
            }

            //Description
            if(isset($request->description)){
                $post->description = $request->description;
            }else{
                $post->description = "";
            }

            //Publish
            if(isset($request->publish)){
                if($request->publish == 'draft'){
                    $post->publish = 0;
                }elseif($request->publish == 'publish'){
                    $post->publish = 1;
                    $post->publish_date = new Carbon;
                }
            }

            //Comment
            if(isset($request->comments)){
                if($request->comments = "on"){
                    $post->comment = 1;
                }
            }

            //Image
            if($request->hasFile('image')){
                $img_temp = $request->file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals'.rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/posts/large/'.$filename;
                    $medium_image_path = 'images/backend_images/posts/medium/'.$filename;


                    //Resize Images
                    Image::make($img_temp)->save($large_image_path);
                    Image::make($img_temp)->fit(500,400)->save($medium_image_path);

                    //Store Images
                    $post->image =$filename;
                }
            }

            $post->save();
            $post->tags()->sync($request->tags,false);
            Session::flash('success',' Post Created Successfully!');
            return redirect()->back();

        }

        return view('back_end.blog.posts.create')->with(compact('categories','tags'));
    }


    public function index()
    {

        $tags = Tag::all();
        $categories = BlogCategory::all();
        $posts = Post::with('category')->with('tags')->get();



        return view('back_end.blog.posts.index')->with(compact('posts','categories','tags'));

    }


    public function show($id){
        $post = Post::with('category')->with('tags')->find($id);
        return view('back_end.blog.posts.show')->with(compact('post'));
    }


    public function edit($id, Request $request){
        //   dd($id);
        $post = Post::with('category')->with('tags')->find($id);
        $tags = Tag::all();
        $categories = BlogCategory::all();

        if($request->isMethod('post')){

            $data = $request->except('name');

            $this->validate($request, [
                'title' => 'required|max:255',
                'body' => 'required',
            ]);
            //Title
            $post->title = $request->title;
            //Slug
            $slug = $this->createSlug($request->title, $id);
            $post->slug = $slug;

            //Category
            if($request->category_id == "Choose Category")
            {
                Session::flash('error','Please Select A Category To Proceed!');
                return redirect()->back();
            }else{
                $post->category_id = $request->category_id;
            }

            //Body
            $dom = new \DOMDocument();
            $dom->loadHtml($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach($images as $img){
                $src = $img->getAttribute('src');
                // if the img source is 'data-url'
                if(preg_match('/data:image/', $src)){
                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                    // Generating a random filename
                    $filename = "mohvisuals".uniqid();
                    $filepath = "/uploads/$filename.$mimetype";

                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                        // resize if required
                        /* ->resize(300, 200) */
                        ->encode($mimetype, 100)  // encode file to the specified mimetype
                        ->save(public_path($filepath));
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                } // <!--endif
            } // <!-

            $post->body = $dom->saveHTML();


            //authors
            if(isset($request->author)){
                $post->author = $request->author;
                $post->author_slug = Str::slug($request->author,'-');
            }else{
                $post->author = "";
                $post->author_slug = "";
            }


            //Keywords
            if(isset($request->keywords)){
                $post->keywords = $request->keywords;
            }else{
                $post->keywords = "";
            }


            //Description
            if(isset($request->description)){
                $post->description = $request->description;
            }else{
                $post->description = "";
            }

            //Publish
            if(isset($request->publish)){
                if($request->publish == 'draft'){
                    $post->publish = 0;
                }elseif($request->publish == 'publish'){
                    $post->publish = 1;
                    $post->publish_date = new Carbon;
                }
            }

            //Comment
            if(isset($request->comment)){
                if($request->comment = "on"){
                    $post->comment = 1;
                }
            }



            //Old Image
            $old_image = $post->image;
            $filename = '';

            //Image
            if($request->hasFile('image')){
                $img_temp = $request->file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'flh'.rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/posts/large/'.$filename;
                    $medium_image_path = 'images/backend_images/posts/medium/'.$filename;


                    //Resize Images
                    Image::make($img_temp)->save($large_image_path);
                    Image::make($img_temp)->fit(500,400)->save($medium_image_path);


                    //Image Sources
                    $large_image_src = 'images/backend_images/posts/large/';
                    $medium_image_src = 'images/backend_images/posts/medium/';


                    //Delete
                    if(file_exists($large_image_src.$old_image)){
                        unlink($large_image_src.$old_image);
                    }
                    if(file_exists($medium_image_src.$old_image)){
                        unlink($medium_image_src.$old_image);
                    }


                }
            } else{
                $filename = $old_image;
            }

            $post->image =$filename;
            $post->save();
            if (isset($request->tags)){
                $post->tags()->sync($request->tags);
            }
            Session::flash('success',' Post updated successfully!');
            return redirect()->route('show.post',$post->id);

        }

        return view('back_end.blog.posts.edit')->with(compact('post','tags','categories'));
    }



    public function delete($id){

        //dd('yes');
        $post = Post::where(['id'=>$id])->first();


        $large_image_src = 'images/backend_images/posts/large/';
        $medium_image_src = 'images/backend_images/posts/medium/';


        //Delete
        if(file_exists($large_image_src.$post->image)){
            unlink($large_image_src.$post->image);
        }
        if(file_exists($medium_image_src.$post->image)){
            unlink($medium_image_src.$post->image);
        }

        PostView::where('post_id',$id)->delete();

        $post->tags()->detach();
        $post->delete();
        Session::flash('success','The post has been deleted successfully!');



        return redirect()->route('posts');
    }



    //Slug Function
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }


    //Hide/Publish and Comments
    public function publishPost($id){
        $post = Post::find($id);
        $post->publish = 1;
        $post->publish_date = new Carbon;

        $post->save();
        Session::flash('success','Published!');
        return back();

    }

    public function hidePost($id){
        $post = Post::find($id);
        $post->publish = 0;

        $post->save();
        Session::flash('success','Hidden!');
        return back();

    }

    public function allowComment($id){
        $post = Post::find($id);
        $post->comment = 1;
        $post->save();
        Session::flash('success','Comment Enabled!');
        return back();
    }

    public function disallowComment($id){
        $post = Post::find($id);
        $post->comment = 0;
        $post->save();
        Session::flash('success','Comment Disabled!');
        return back();
    }


}










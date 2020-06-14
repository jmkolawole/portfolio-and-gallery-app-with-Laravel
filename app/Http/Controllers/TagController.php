<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class TagController extends Controller
{
    //
    public function index(){
        $tag = Tag::paginate(12);
        return view('back_end.blog.tags.index')->with(compact('tag'));
    }

    public function addTag(Request $request){


        $this->validate($request,[
            'name'=>'required',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->slug = Str::slug($tag->name,'-');

        $tag->save();
        Session::flash('success','New tag added successfully!');

        return redirect()->route('tags');
    }


    public function newTag(){
        $input = request()->all();
        $tag = new Tag;
        $name = request()->name;
        $tag_count = Tag::where('name',$name)->count();
        if($tag_count > 0){
            return response()->json(['error'=>'error']);
        }else{
            $slug = Str::slug($name,'-');
            $tag->name = $name;
            $tag->slug = $slug;
            $tag->save();
            return response()->json(['success'=>$slug,'id'=>$tag->id,'name'=>$name]);
        }

    }


    public function checkTag(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $name = $data['name'];
            $tag_count = Tag::where('name',$name)->count();
            if($tag_count > 0){

                echo 'exists';
            }else{

                $tag = new Tag;
                $slug = Str::slug($name,'-');
                $tag->name = $name;
                $tag->slug = $slug;
                $tag->save();
                return response()->json(['success'=>$slug,'id'=>$tag->id,'name'=>$name]);

            }
        }
    }


    public function editTag(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
        ]);

        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->slug = Str::slug($tag->name,'-');

        $tag->save();
        Session::flash('success','Tag details edited successfully!');
        return redirect()->route('tags');
    }



    public function deleteTag(Request $request,$id){
        $tag = Tag::find($id);
        $tag->delete();
        Session::flash('success','Tag deleted successfully!');
        return redirect()->route('tags');
    }

    public function showResources($slug){
        $tag = Tag::where('slug', '=', $slug)->first();
        $tag_name = $tag->name;
        $posts = $tag->posts()->orderBy('id','desc')->paginate(1);
        return view('back_end.blog.tags.posts')->with(compact('posts','tag_name','tag'));
    }




}

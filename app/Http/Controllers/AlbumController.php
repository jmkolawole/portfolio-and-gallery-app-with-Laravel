<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
use Image;
use Session;
use Illuminate\Support\Facades\Input;

class AlbumController extends Controller
{
    //

    public function index(){

      $album = Album::orderBy('id','desc')->paginate(12);
      return view('back_end.albums.index')->with(compact('album'));
    }

    public function create(Request $request){
        $categories = Category::all();

        if($request->isMethod('post')){
            $data = $request->all();
            $album = new Album;
            $album->name = $data['name'];
            $album->category_id = $data['category_id'];
            $album->slug = Str::slug($album->name,'-');


            if(!empty($data['description'])){
                $album->description = $data['description'];;
            }else{
                $album->description = '';
            }

            if($request->hasFile('cover_image')){
                $img_temp = Input::file('cover_image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals'.rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/albums/large/'.$filename;
                    $medium_image_path = 'images/backend_images/albums/medium/'.$filename;
                    $small_image_path = 'images/backend_images/albums/small/'.$filename;

                    //Resize Images
                    Image::make($img_temp)->save($large_image_path);
                    Image::make($img_temp)->fit(500,400)->save($medium_image_path);
                    //Image::make($img_temp)->resize(500,400)->save($medium_image_path);
                    //Image::make($img_temp)->resize(300,300)->save($small_image_path);
                    Image::make($img_temp)->fit(300,300)->save($small_image_path);

                    //Store Images
                    $album->cover_image =$filename;
                }
            }

            $album->save();
            Session::flash('success',' Album created successfully!');
            return redirect()->route('album.show',$album->id);

        }


        return view('back_end.albums.create')->with(compact('categories'));
    }


    public function show($id){
        $pictures = Album::with('photo')->find($id);
        $images = Photo::orderBy('id','desc')->where('album_id',$id)->paginate(12);
        return view('back_end.albums.show')->with(compact('pictures','images'));

    }



    public function edit(Request $request, $id){
        $album = Album::where('id','=',$id)->first();
        $categories = Category::all();

        if($request->isMethod('post')){
            $data = $request->all();
            $album = Album::find($id);
            $filename = '';
            $old_image = $album->cover_image;
            $album->name = $data['name'];
            $album->category_id = $data['category_id'];
            $album->slug = Str::slug($album->name,'-');


            if(!empty($data['description'])){
                $album->description = $data['description'];
            }else{
                $album->description = '';
            }

            if($request->hasFile('cover_image')){
                $img_temp = Input::file('cover_image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/albums/large/'.$filename;
                    $medium_image_path = 'images/backend_images/albums/medium/'.$filename;
                    $small_image_path = 'images/backend_images/albums/small/'.$filename;

                    //Resize Images
                    Image::make($img_temp)->save($large_image_path);
                    Image::make($img_temp)->resize(500,400)->save($medium_image_path);
                    Image::make($img_temp)->resize(300,300)->save($small_image_path);

                    //Delete old image
                    $large_image_src = 'images/backend_images/albums/large/';
                    $medium_image_src = 'images/backend_images/albums/medium/';
                    $small_image_src = 'images/backend_images/albums/small/';

                    //Delete
                    if(file_exists($large_image_src.$old_image)){
                        unlink($large_image_src.$old_image);
                    }
                    if(file_exists($medium_image_src.$old_image)){
                        unlink($medium_image_src.$old_image);
                    }
                    if(file_exists($small_image_src.$old_image)){
                        unlink($small_image_src.$old_image);
                    }

                }
            }else{
                $filename = $old_image;
            }

            $album->cover_image = $filename;

            $album->save();
            Session::flash('success',' Album details successfully changed!');
            return redirect()->route('album.show',$id);
        }

        return view('back_end.albums.edit')->with(compact('album','categories'));
    }


    public function delete($id){
        $album = Album::where(['id'=>$id])->first();
        $photos = Photo::where('album_id','=',$album->id)->get();
        //$count = $photos-


        $large_image_src = 'images/backend_images/albums/large/';
        $medium_image_src = 'images/backend_images/albums/medium/';
        $small_image_src = 'images/backend_images/albums/small/';

        //Delete
        if(file_exists($large_image_src.$album->cover_image)){
            unlink($large_image_src.$album->cover_image);
        }
        if(file_exists($medium_image_src.$album->cover_image)){
            unlink($medium_image_src.$album->cover_image);
        }
        if(file_exists($small_image_src.$album->cover_image)){
            unlink($small_image_src.$album->cover_image);
        }

        foreach($photos as $photo){
            $large_image_path = 'images/backend_images/photos/large/';
            $medium_image_path = 'images/backend_images/photos/medium/';
            $small_image_path = 'images/backend_images/photos/small/';

            //Delete
            if(file_exists($large_image_path.$photo->image)){
                unlink($large_image_path.$photo->image);
            }
            if(file_exists($medium_image_path.$photo->image)){
                unlink($medium_image_path.$photo->image);
            }
            if(file_exists($small_image_path.$photo->image)){
                unlink($small_image_path.$photo->image);
            }

        }

        $album->delete();
        Session::flash('success','The album has been deleted successfully!');
        return redirect()->route('album.index');
    }


    public function deleteImage($id){
        $album = Album::where('id','=',$id)->first();
        $large_image_path = 'images/backend_images/albums/large/';
        $medium_image_path = 'images/backend_images/albums/medium/';
        $small_image_path = 'images/backend_images/albums/small/';

        //Delete
        if(file_exists($large_image_path.$album->cover_image)){
            unlink($large_image_path.$album->cover_image);
        }
        if(file_exists($medium_image_path.$album->cover_image)){
            unlink($medium_image_path.$album->cover_image);
        }
        if(file_exists($small_image_path.$album->cover_image)){
            unlink($small_image_path.$album->cover_image);
        }


        Album::where(['id'=>$id])->update(['cover_image'=>'']);
        Session::flash('success','Album cover deleted successfully!');
        return redirect()->back();
    }
}

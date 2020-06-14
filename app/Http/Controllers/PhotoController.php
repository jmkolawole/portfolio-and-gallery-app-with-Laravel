<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Album;
use Illuminate\Support\Facades\Input;
use Image;
use File;
use Session;

class PhotoController extends Controller
{
    //
    public function create(Request $request, $id){
        if($request->isMethod('post')){
            $photo = new Photo;


            $photo->album_id = $id;


            $image = $request->file('file');
            if($image){


                $extension = $image->getClientOriginalExtension();
                $imageName = 'movisuals'.rand(111,9999).'.'.$extension;


                $large_image_path = 'images/backend_images/photos/large';

                $medium_image_path = 'images/backend_images/photos/medium';
                $small_image_path = 'images/backend_images/photos/small';

                $img = Image::make($image->getRealPath());

                //Save to Large Folder
                //$img->save($large_image_path.'/'.$imageName);
                $img->save($large_image_path.'/'.$imageName);


                //Save to Medium folder
                $img->resize(600, 600)->save($medium_image_path.'/'.$imageName);


                //Save to small folder
                $img->resize(100, 100)->save($small_image_path.'/'.$imageName);


                $photo->image = $imageName;


            }

            $photo->save();
            Session::flash('success','Photo(s) added successfully!');
            //return redirect()->route('album.show',$id);

        }

        $album = Album::where('id','=',$id)->first();
        return view('back_end.photos.create')->with(compact('album'));

    }


    public function show($album_id,$pic){

        $image = Photo::where('album_id','=',$album_id)->where('image','=',$pic)->first();
        return view('back_end.photos.show')->with(compact('image'));
    }


    public function delete($pic){
     $photo = Photo::where('id','=',$pic)->first();
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
     $album_id = $photo->album_id;
     $photo->delete();
        Session::flash('success','Photo deleted successfully!');
        return redirect()->route('album.show',$album_id);
    }

}




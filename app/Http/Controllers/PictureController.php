<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Picture;
use Illuminate\Support\Facades\Input;
use Image;
use Session;

class PictureController extends Controller
{
    //
    public function index(){
        $pictures = Picture::orderBy('id','desc')->paginate(12);
        return view('back_end.pictures.index')->with(compact('pictures'));
    }


    public function create(Request $request){

        $categories = Category::all();

        if($request->isMethod('post')){
            $data = $request->all();
            $picture = new Picture;
            $picture->category_id = $data['category_id'];

            if(!empty($data['feature'])){
                $picture->feature = 1;
            }
            else{
                $picture->feature = 0;
            }


            if(!empty($data['description'])){
                $picture->description = $data['description'];;
            }else{
                $picture->description = '';
            }

            if($request->hasFile('image')){
                $img_temp = Input::file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals'.rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/pictures/large/'.$filename;
                    $medium_image_path = 'images/backend_images/pictures/medium/'.$filename;
                    $small_image_path = 'images/backend_images/pictures/small/'.$filename;

                    //Resize Images
                    Image::make($img_temp)->save($large_image_path);
                    Image::make($img_temp)->resize(600,825, function ($constraint){
                        $constraint->aspectRatio();
                    })->save($medium_image_path);
                    Image::make($img_temp)->resize(200,200, function ($constraint){
                        $constraint->aspectRatio();
                    })->save($small_image_path);

                    //Store Images
                    $picture->image =$filename;
                }
            }

            $picture->save();
            Session::flash('success','Picture uploaded successfully!');
            return redirect()->route('picture.index');

        }
        return view('back_end.pictures.create')->with(compact('categories'));


    }

    public function show($id){
        $picture = Picture::where('id','=',$id)->first();
        return view('back_end.pictures.show')->with(compact('picture'));
    }


    public function edit(Request $request, $id){
        $categories = Category::all();
        $picture = Picture::find($id);

        if($request->isMethod('post')){
            $data = $request->all();
            $filename = '';
            $old_image = $picture->image;
            $picture->category_id = $data['category_id'];

            if(!empty($data['description'])){
                $picture->description = $data['description'];
            }else{
                $picture->description = '';
            }
            if(!empty($data['feature'])){
                $picture->feature = 1;
            }
            else{
                $picture->feature = 0;
            }

            if($request->hasFile('image')){
                $img_temp = Input::file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals'.rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/pictures/large/'.$filename;
                    $medium_image_path = 'images/backend_images/pictures/medium/'.$filename;
                    $small_image_path = 'images/backend_images/pictures/small/'.$filename;

                    //Resize Images
                    Image::make($img_temp)->save($large_image_path);
                    Image::make($img_temp)->resize(600,825)->save($medium_image_path);
                    Image::make($img_temp)->resize(200,200)->save($small_image_path);

                    //Delete old image
                    $large_image_src = 'images/backend_images/pictures/large/';
                    $medium_image_src = 'images/backend_images/pictures/medium/';
                    $small_image_src = 'images/backend_images/pictures/small/';

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


            $picture->image = $filename;

            $picture->save();
            Session::flash('success','Picture updated successfully!');
            return redirect()->route('picture.index');

        }

        return view('back_end.pictures.edit')->with(compact('categories','picture'));
    }


    public function delete($id){
        $picture = Picture::where('id','=',$id)->first();
        $large_image_path = 'images/backend_images/pictures/large/';
        $medium_image_path = 'images/backend_images/pictures/medium/';
        $small_image_path = 'images/backend_images/pictures/small/';

        //Delete
        if(file_exists($large_image_path.$picture->image)){
            unlink($large_image_path.$picture->image);
        }
        if(file_exists($medium_image_path.$picture->image)){
            unlink($medium_image_path.$picture->image);
        }
        if(file_exists($small_image_path.$picture->image)){
            unlink($small_image_path.$picture->image);
        }

        $picture->delete();
        Session::flash('success','Picture deleted successfully!');
        return redirect()->route('picture.index');
    }


}

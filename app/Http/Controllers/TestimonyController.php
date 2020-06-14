<?php

namespace App\Http\Controllers;

use App\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Session;

class TestimonyController extends Controller
{
    public function index(){
        $testimonies = Testimony::orderBy('id','desc')->paginate(10);
        return view('back_end.testimonies.index')->with(compact('testimonies'));

    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $testimony = new Testimony;
            $testimony->name = $data['name'];

            if(empty($data['body'])){
            echo 'error';die;
            }else{
             $testimony->body = $data['body'];
            }

            if($request->hasFile('image')){
                $img_temp = Input::file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals'.rand(111,9999).'.'.$extension;

                    $image_path = 'images/backend_images/testimonies/'.$filename;

                    //Resize Images
                    Image::make($img_temp)->fit(600,600)->save($image_path);
                    //Image::make($img_temp)->resize(600,600)->save($image_path);


                    //Store Images
                    $testimony->image =$filename;
                }
            }

            $testimony->save();
            Session::flash('success','Testimony saved successfully!');
            return redirect()->route('testimony.index');

        }

        return view('back_end.testimonies.create');



    }


    public function edit(Request $request, $id){
        $testimony = Testimony::where('id','=',$id)->first();

        if($request->isMethod('post')){

            $data = $request->all();
            $filename = '';
            $old_image = $testimony->image;
            $testimony->name = $data['name'];


            if(!empty($data['body'])){
                $testimony->body = $data['body'];
            }else{
                $testimony->body = '';
            }

            if($request->hasFile('image')){
                $img_temp = Input::file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals'.rand(111,9999).'.'.$extension;

                    $image_path = 'images/backend_images/testimonies/'.$filename;

                    //Resize Images

                    Image::make($img_temp)->resize(600,600)->save($image_path);


                    //Delete old image
                    $image_src = 'images/backend_images/testimonies/';


                    //Delete
                    if(file_exists($image_src.$old_image)){
                        unlink($image_src.$old_image);
                    }


                }
            }else{
                $filename = $old_image;
            }

            $testimony->image = $filename;

            $testimony->save();
            Session::flash('success','Testimony updated successfully!');
            return redirect()->route('testimony.index');
        }

        return view('back_end.testimonies.edit')->with(compact('testimony'));
    }



    public function show($id){
        $testimony = Testimony::where('id','=',$id)->first();
        return view('back_end.testimonies.show')->with(compact('testimony'));
    }


    public function delete($id){
        $testimony = Testimony::where(['id'=>$id])->first();

        $image_src = 'images/backend_images/testimonies/';


        //Delete
        if(file_exists($image_src.$testimony->image)){
            unlink($image_src.$testimony->image);
        }


        $testimony->delete();
        Session::flash('success','Testimony has been deleted successfully!');
        //Session::flash('success','The product has been deleted successfully!');
        return redirect()->route('testimony.index');
    }


}

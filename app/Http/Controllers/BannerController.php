<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Image;
use Session;

class BannerController extends Controller
{
    //
    public function index(){
        $banners = Banner::all();
        return view('back_end.banners.index')->with(compact('banners'));
    }

    public function edit(Request $request, $id){
        $banner = Banner::with('category')->where('id','=',$id)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $filename = '';
            $old_image = $banner->image;

            if($request->hasFile('image')) {
                $img_temp = Input::file('image');
                if ($img_temp->isValid()) {

                    //$canvas = Image::canvas(550, 680);

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals' . rand(111, 9999) . '.' . $extension;

                    $image_path = 'images/backend_images/banners/' . $filename;

                    //Resize Images

                    //Image::make($img_temp)->resize(550,680)->save($image_path);

                   /* $image  = Image::make($img_temp)->resize(550, 680, function($constraint)
                    {
                        $constraint->aspectRatio();
                    });

                    $canvas->insert($image, 'center');
                    $canvas->save($image_path);
                   */

                    //Image::make($img_temp)->save($image_path);

                    Image::make($img_temp)->fit(550,620)->save($image_path);


                    //Delete old image
                    $image_src = 'images/backend_images/banners/';


                    //Delete
                    if (file_exists($image_src . $old_image)) {
                        unlink($image_src . $old_image);
                    }
                }

            }

            $banner->image = $filename;

            $banner->save();
            Session::flash('success',' Banner changed successfully!');
            return redirect()->route('banner.index');
        }

        $lifestyle = Banner::with('category')->where('category_id','=',1)->first();
        $wedding = Banner::with('category')->where('category_id','=',2)->first();
        $fashion = Banner::with('category')->where('category_id','=',3)->first();
        $portrait = Banner::with('category')->where('category_id','=',4)->first();

        return view('back_end.banners.edit')->with(compact('banner','lifestyle','wedding','fashion','portrait'));
    }













    public function indexHome(){
        $banner = DB::table('page_banner')->where('id','=',1)->first();
        return view('back_end.banners.indexHome')->with(compact('banner'));
    }


    public function editHome(Request $request){
        $banner = DB::table('page_banner')->where('id','=',1)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $filename = '';
            $old_image = $banner->image;
            $text_1 = $data['text_1'];
            $text_2 = $data['text_2'];

            if(!empty($data['text_1'])){
                $text_1 = $data['text_1'];
            }else{
                $text_1 = '';
            }
            if(!empty($data['text_2'])){
                $text_2 = $data['text_2'];
            }else{
                $text_2 = '';
            }



            if($request->hasFile('image')){
                $img_temp = Input::file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'mohvisuals'.rand(111,9999).'.'.$extension;
                    $image_path = 'images/backend_images/banners/'.$filename;

                    //Resize Images
                    Image::make($img_temp)->save($image_path);
                    Image::make($img_temp)->resize(2000,1333)->save($image_path);

                    //Delete old image
                    $image_src = 'images/backend_images/banners/';

                    //Delete
                    if(file_exists($image_src.$old_image)){
                        unlink($image_src.$old_image);
                    }

                }
            }else{
                $filename = $old_image;
            }

            $banner->image = $filename;


            DB::table('page_banner')->where('id','=',1)->update(['image'=>$filename,'text_1'=>$text_1,'text_2'=>$text_2]);
            Session::flash('success','Page Banner edited successfully!');
            return redirect()->route('banner.home.index');
        }


        return view('back_end.banners.editHome')->with(compact('banner'));
    }
}

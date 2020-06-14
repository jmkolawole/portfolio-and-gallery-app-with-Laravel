<?php

namespace App\Http\Controllers;

use App\Album;
use App\Picture;
use Illuminate\Http\Request;
use App\Category;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Illuminate\Support\Str;
use Session;


class CategoryController extends Controller
{
    //
    public function index(){
        $category = Category::paginate(4);
        return view('back_end.categories.index')->with(compact('category'));
    }

    public function addCategory(Request $request){


        $this->validate($request,[
            'name'=>'required',
        ]);


        $category = new Category;
        $category->name = $request->name;
        if(empty($request->description)){
            $category->description = "";
        }else{
            $category->description = $request->description;
        }
        $category->slug = Str::slug($category->name,'-');

        $category->save();
        Session::flash('success','New category added successfully!');

        return redirect()->route('category.index');


    }


    public function editCategory(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        if(empty($request->description)){
            $category->description = "";
        }else{
            $category->description = $request->description;
        }
         $category->slug = Str::slug($category->name,'-');

        $category->save();
        Session::flash('success','Category details edited successfully!');
        return redirect()->route('category.index');



    }


    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        Session::flash('success','Category deleted successfully!');
        return redirect()->route('category.index');
    }


    public function showResources($slug){

        $category = Category::where('slug','=',$slug)->first();
        $id = $category->id;
        $name= $category->name;
        $pictures = Picture::where('category_id','=',$id)->paginate(12);
        $albums = Album::where('category_id','=',$id)->paginate(12);
        return view('back_end.categories.resources')->with(compact('name','pictures','albums','category'));

    }
}

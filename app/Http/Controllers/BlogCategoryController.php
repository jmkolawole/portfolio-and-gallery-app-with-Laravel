<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class BlogCategoryController extends Controller
{
    //
    public function index(){
        $category = BlogCategory::paginate(12);
        return view('back_end.blog.categories.index')->with(compact('category'));
    }

    public function addCategory(Request $request){

        $this->validate($request,[
            'name'=>'required',
        ]);


        $category = new BlogCategory;
        $category->name = $request->name;
        if(empty($request->description)){
            $category->description = "";
        }else{
            $category->description = $request->description;
        }
        $category->slug = Str::slug($category->name,'-');

        $category->save();
        Session::flash('success','New category added successfully!');

        return redirect()->route('blog.categories');

    }


    public function editCategory(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
        ]);

        $category = BlogCategory::find($id);
        $category->name = $request->name;
        if(empty($request->description)){
            $category->description = "";
        }else{
            $category->description = $request->description;
        }
        $category->slug = Str::slug($category->name,'-');

        $category->save();
        Session::flash('success','Category details edited successfully!');
        return redirect()->route('blog.categories');
    }


    public function deleteCategory(Request $request, $id){
        $category = BlogCategory::find($id);
        $category->delete();
        Session::flash('success','Category deleted successfully!');
        return redirect()->route('blog.categories');
    }



    public function showResources($slug){
        $category = BlogCategory::where('slug', '=', $slug)->first();
        $cat_name = $category->name;
        $posts = Post::where('category_id',$category->id)->orderBy('id','desc')->paginate(2);
        return view('back_end.blog.categories.posts')->with(compact('posts','cat_name','category'));
    }

}

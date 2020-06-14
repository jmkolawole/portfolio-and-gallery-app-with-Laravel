<?php

namespace App\Http\Controllers;
use App\Album;
use App\Banner;
use App\Picture;
use App\Post;
use App\Subscriber;
use App\Testimony;
use Illuminate\Support\Str;
use Session;
use App\User;
use App\Role;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Category;
class AdminController extends Controller
{
    //
    public function dashboard(){

        $albums = Album::orderBy('id','desc')->take(5)->get();
        $categories = Category::orderBy('id','desc')->take(4)->get();
        $pictures = Picture::orderBy('id','desc')->take(5)->get();
        $testimonies = Testimony::orderBy('id','desc')->take(4)->get();
        $banner = DB::table('page_banner')->where('id','=',1)->first();
        $banners = Banner::all();
        $users = User::with('roles')->where('id','<>',1)->get();
        $subscribers = Subscriber::orderBy('id','desc')->take(5)->get();
        return view('back_end.dashboard')->with(compact('albums','categories','pictures','testimonies','banner','banners','users','subscribers'));
    }

    public function __construct()
    {
        $this->middleware('web');
    }

    public function showRegForm(){
        return view('admin.auth.register');
    }

    public function addUser(Request $request){
        $this->validation($request);
        $user = new User();
        $user->name = $request->username;
        $user->slug = Str::slug($request->username,'-');
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach(Role::where('name', 'User')->first());
        Session::flash('success',' The user has been successfully created!');
        return redirect()->route('show.users');
    }

    public function validation($request)
    {
        return $this->validate($request ,[
            'username'=> 'required|max:255',
            'email'=> 'required|email|unique:users|max:255',
            'password'=> 'required|max:255|confirmed'
        ]);
    }


    public function showUsers(){
        $users = User::where('id','<>',1)->get();
        return view('back_end.auth.showUsers')->withUsers($users);
    }


    public function editUser(Request $request){
        $id = $request->id;
        $user = User::where('id','=',$id)->first();
        $user->name = $request->username;
        $user->slug = Str::slug($request->username,'-');
        $user->email = $request->email;

        //$user->active = '';
        if(empty($request->active)){
            $user->active = 0;

        }else{
            $user->active = 1;
        }
        $user->save();

        Session::flash('success',' The user details have been successfully edited!');
        return redirect()->route('show.users');
    }



    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        User::where('id','=',$id)->delete();
        Session::flash('success',' The user has been successfully deleted!');
        return redirect()->route('show.users');
    }

    public function assignUser(Request $request){
        $user = User::where('id', $request['id'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        Session::flash('success',' New role(s) assigned to user!');
        return redirect()->back();
    }



    //For logged in users now


    public function showProfile(){

        $id = Auth::user()->id;

        $user = User::find($id);
        return view('back_end.auth.show')->withUser($user);
    }



    public function editProfile(Request $request){

        $id = Auth::user()->id;
        $user = User::find($id);

        if($request->isMethod('POST')){
         $user->name = $request->name;
         $user->email = $request->email;
         $user->slug = Str::slug($request->name,'-');
            $filename = '';
            if($user->image == null){
                if($request->hasFile('image')) {
                    $img_temp = Input::file('image');
                    if ($img_temp->isValid()) {

                        $extension = $img_temp->getClientOriginalExtension();
                        $filename = 'mohvisuals' . rand(111, 9999) . '.' . $extension;

                        $image_path = 'images/backend_images/users/' . $filename;

                        //Resize Images

                        Image::make($img_temp)->resize(300, 300)->save($image_path);
                    }

                }
            }else{
                $old_image = $user->image;

                if($request->hasFile('image')) {
                    $img_temp = Input::file('image');
                    if ($img_temp->isValid()) {

                        $extension = $img_temp->getClientOriginalExtension();
                        $filename = 'mohvisuals' . rand(111, 9999) . '.' . $extension;

                        $image_path = 'images/backend_images/users/' . $filename;

                        //Resize Images

                        Image::make($img_temp)->resize(300, 300)->save($image_path);

                        //Delete
                        $image_src = 'images/backend_images/users/';


                        //Delete
                        if(file_exists($image_src.$old_image)){
                            unlink($image_src.$old_image);
                        }

                    }

                }else{
                    $filename = $old_image;
                }

            }

            $user->image = $filename;
            $user->save();

            Session::flash('success',' Your details have been changed successfully!');
            return redirect()->route('show.profile');

        }

        return view('back_end.auth.edit')->withUser($user);
    }

    public function editPassword(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        if($request->isMethod('post')){
            $this->validate($request, [
                'password'=> 'required|max:255|confirmed'
            ]);
            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->save();
            Session::flash('success',' Password successfully updated!');
            return redirect()->route('show.profile');
        }
        return view('back_end.auth.password')->withUser($user);
    }


    public function showResources($id){
        $user = User::where('id',$id)->first();
        $posts = Post::where('user_id',$id)->paginate(10);

        return view('back_end.blog.authors.posts')->with(compact('posts','user'));

    }


}

<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Subscriber;
use App\Testimony;
use App\View;
use App\AlbumView;
use Illuminate\Http\Request;
use App\Picture;
use App\Album;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PagesController extends Controller
{
    //
    public function home(){

        $pictures = Picture::orderBy('id','desc')->where('feature','=',1)->limit(8)->get();
        $banners = Banner::all();
        $home_banner = DB::table('page_banner')->where('id','=',1)->first();
        $albums = Album::with('photo')->with('category')->orderBy('id','desc')->limit(9)->get();
        $testimonies = Testimony::orderBy('id','desc')->limit(3)->get();
        return view('front_end.pages.home')->with(compact('pictures','albums','testimonies','banners','home_banner'));
    }

    public function about(){
        return view('front_end.pages.about');
    }

    public function gallery(){
        $categories = Category::all();
        $albums = Album::orderBy('id','desc')->paginate(12);
        return view('front_end.pages.gallery')->with(compact('categories','albums'));
    }


    public function portfolio($slug){
        $id = Category::where('slug','=',$slug)->first();
        $count = Category::where('slug','=',$slug)->count();
        if($count == 0){
            abort(404);
        }
        $id_number = $id->id;
        $category_name = $id->name;

        $pictures = Picture::where('category_id','=',$id_number)->orderBy('id','desc')->paginate(12);
        return view('front_end.pages.portfolio')->with(compact('pictures','category_name','slug','id_number'));
    }


    public function albumPhotos($slug){
        $album = Album::with('photo')->where('slug','=',$slug)->first();
        $count = Album::with('photo')->where('slug','=',$slug)->count();
        if($count == 0){
            abort(404);
        }
        AlbumView::createViewLog($album);

        return view('front_end.pages.album')->with(compact('album'));
    }

    public function picture($image){
        $picture = Picture::with('category')->where('image','=',$image)->first();
        $count = Picture::with('category')->where('image','=',$image)->count();
        if($count == 0){
            abort(404);
        }
        $next = Picture::where('id','>',$picture->id)->first();
        $previous = Picture::where('id','<',$picture->id)->orderBy('id','desc')->first();
        View::createViewLog($picture);
        return view('front_end.pages.picture')->with(compact('picture','next','previous'));

    }


    public function contact(Request $request){

        if($request->isMethod('post')){


            $this->validate($request,[
                'email' => 'required|email',
                'subject'=>'min:3',
                'message'=> 'min:10',
            ]);

            if(empty($request->phone)){
                $subject = $request->subject;
            }else{
                $subject = $request->subject .'('.$request->phone.')';
            }


            $data = array(
                'email' => $request->email,
                'subject' => $subject,
                'bodyMessage' => $request->message
            );

            Mail::send('emails.contact_us',$data,function($message) use ($data){

                $message->from($data['email']);
                $message->to('support@mohvisualstudios.com');
                $message->subject($data['subject']);


            });

            return redirect()->back();
        }

        return view('front_end.pages.contact');
    }


    public function albumArchive($month,$year){

        $categories = Category::all();
        $mth = date('m', strtotime($month));

        $albums = Album::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $mth)->paginate(6);
        $date = $month.', '.$year;

        $count = Album::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $mth)->count();
        if($count == 0){
            abort(404);
        }

        return view('front_end.archives.albums')->with(compact('albums','date','categories'));

    }


    public function pictureArchive($month, $year){

        $mth = date('m', strtotime($month));

        $pictures = Picture::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $mth)->paginate(6);
        $date = $month.', '.$year;

        $count = Picture::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $mth)->count();
        if($count == 0){
            abort(404);
        }

        return view('front_end.archives.pictures')->with(compact('pictures','date'));

    }


    public function checkSubscriberEmail(Request $request){

        if($request->ajax()){
            $data = $request->all();
            $subscriber_count = Subscriber::where('email',$data['subscriber_email'])->count();
            if($subscriber_count > 0){

                echo 'exists';
            }
        }
    }





    public function addSubscriberEmail(Request $request){

        if($request->ajax()){
            $data = $request->all();
            $subscriber_count = Subscriber::where('email',$data['subscriber_email'])->count();
            if($subscriber_count > 0){

                echo 'exists';
            }else{
                $token = Str::random(32);
                $subscriber = new Subscriber;
                $subscriber->email = $data['subscriber_email'];
                $subscriber->status = 0;
                $subscriber->save();
                DB::table('verify_subscribers')->insert(['email' => $subscriber->email, 'token' => $token, 'created_at' => new Carbon]);
                //trigger mail
               Mail::to($subscriber->email)->send(new \App\Mail\Subscriber($subscriber, $token));
                echo 'saved';
            }
        }
    }


    public function verifySubscriber($email,$token){
        $subscriber = DB::table('verify_subscribers')->where('email','=',$email)->where('token','=',$token)->first();
        $verified_subscriber = Subscriber::where('email','=',$subscriber->email)->first();
        if(!$verified_subscriber){

        }
        else{
            $verified_subscriber->status = 1;
            $verified_subscriber->update();
            DB::table('verify_subscribers')->where('email', $verified_subscriber->email)->delete();
            return redirect()->route('home');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Exports\SubscriberExport;
use App\Jobs\sendNewsletterEmail;
use App\Mail\Newsletters;
use App\Post;
use App\Subscriber;
use App\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Excel;
use Session;

class SubscriberController extends Controller
{
    //
    public function sendNewsletter($id){
        $post = Post::where('id',$id)->first();
        $subscribers = Subscriber::where('status',1)->get();

        foreach($subscribers as $subscriber){
            dispatch(new sendNewsletterEmail($subscriber,$post));
            //Mail::to($subscriber->email)->send(new Newsletters($subscriber,$post));
        }

        Session::flash('success',' Newsletters Sent To Subscribers!');
        return redirect()->back();
    }

    public function index(){
        $subscribers = Subscriber::paginate(20);

        return view('back_end.blog.subscribers.index')->with(compact('subscribers'));
    }

    public function delete($id){
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        Session::flash('success',' Subscriber Deleted Successfully!');
        return redirect()->back();
    }


    public function exportSubscriberEmail(){

        //return Excel::download(new SubscriberExport, 'subscribers.xlsx');

        $subscribers = new SubscriberExport();

        return Excel::download($subscribers, 'subscribers.xlsx');
    }



}


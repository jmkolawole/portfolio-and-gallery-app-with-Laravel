<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Mail;
use Session;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function __construct()
    {
        $this->middleware('guest');
    }


    public function ResetLinkEmail(Request $request){

        $user = User::where('email','=',$request->email)->first();


        if($user){
            $password_broker = app(PasswordBroker::class);
            //create reset password token
            $token = $password_broker->createToken($user);
            $code = $token;
            $this->sendEmail($user,$code);

            Mail::to('jmkolawole@gmail.com')->send(new ForgotPassword());

            DB::table('password_resets')->insert(['email' => $user->email, 'token' => $token, 'created_at' => new Carbon]);

            return redirect()->back()->with([
                'success' => 'A reset link has been sent to your email'
            ]);

        }else{
            Session::flash('success',' This email address do not exist!');
            return redirect()->back();

        }

    }



    private function sendEmail($user,$code){
        Mail::send('emails.forgot-password', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user){
            $message->to($user->email);
            $message->from('support@mohvisualstudios.com');
            $message->subject("(Moh Visuals) Hello $user->username, reset your password");
        });
    }
}

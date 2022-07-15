<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\Subscribe;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function create(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully');
        }else{
            return redirect()->back->with('fail','Something went wrong, failed to register');
        }
    }

    function check(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|max:30'
        ]);

        $creds = $request->only('email','password');
        if( Auth::guard('web')->attempt($creds) ){
            return redirect()->route('user.home');
        }else{
            return redirect()->route('user.login')->with('fail','Incorrect credentials');
        }
    }

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function showForgotForm(){
        return view('dashboard.user.forgot');
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);

        $action_link = route('user.reset.password.form',['token'=>$token,'email'=>$request->email]);
        $body = "We are received a request to reset the password for <b>CEYPETCO </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

       \Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
             $message->from('noreply@example.com','CEYPETCO');
             $message->to($request->email,'Your name')
                     ->subject('Reset Password');
        });

        return back()->with('success','We have e-mailed your password reset link!');

    }

    public function showResetForm(Request $request, $token = null){
        return view('dashboard.user.reset')->with(['token'=>$token,'email'->$request->email]);
    }
}

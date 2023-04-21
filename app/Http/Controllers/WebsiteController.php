<?php

namespace App\Http\Controllers;

use App\Mail\Websitemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function registration()
    {
        return view('registration');
    }

    public function registrationSubmit(Request $request)
    {
        $token = hash('sha256', time());
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Pending',
            'token' => $token,
//            'role'=>2
        ]);
        $verificationLink = url('registration/verify/' . $token . '/' . $request->email);
        $subject = "Registration confirmation";
        $message = 'Click below link to confirm your account <br> <a href=" ' . $verificationLink . ' ">Clicke Here</a> ';
        Mail::to($request->email)->send(new Websitemail($subject, $message));
        echo 'Email is sent';
    }

    public function registrationVerification($token, $email)
    {
        $user = User::where(['email' => $email, 'token' => $token])->first();
        if (!$user) {
            return redirect()->route('login');
        }
        $user->status = 'Active';
        $user->token = '';
        $user->update();
        echo 'User Registration is Successfull!';
    }

    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Active'
        ];
        if (Auth::attempt($credentials)) {
//            if(Auth::user()->role==2){
                return redirect()->route('dashboard_user');
//            }
//        else{
//                return redirect()->route('dashboard_admin');
//            }

        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function PasswordForgot()
    {
        return view('forget_password');
    }

    public function SubmitPasswordForgot(Request $request)
    {
        $token = hash('sha256',time());
        $user = User::where('email',$request->email)->first();
        if(!$user)
        {
            echo 'email not found!!';
        }
        $user->token = $token;
        $user->update();

        $resetLink = url('reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Please click on the following link to reset your password: <br><a href="'.$resetLink.'">Click here</a>';
        Mail::to($request->email)->send(new Websitemail($subject,$message));
        echo 'check your mail';
    }
    public function ResetPassword($token,$email)
    {
        $user = User::where(['token'=>$token,'email'=>$email])->first();
        if(!$user){
            return redirect()->route('login');
        }
        return view('reset_password',compact('token','email'));
    }
    public function ResetPasswordSubmit(Request $request)
    {
        $user = User::where(['email'=>$request->email,'token'=>$request->token])->first();
        $user->token = '';
        $user->password = Hash::make($request->new_password);
        $user->update();
        echo 'Password is reset';
    }
    public function Settings()
    {
        return view('settings');
    }
//    public function dashboardAdmin()
//    {
//        return view('dashboard_admin');
//    }
    public function dashboardUser()
    {
        return view('dashboard_user');
    }
}

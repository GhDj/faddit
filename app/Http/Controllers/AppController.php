<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Mail;


class AppController extends Controller
{
    public function index(){
        return view('logged');
    }
    public function ShowNicknameView()
    {
        return view('app.nickname');
    }
    public function PostNickname(Request $request)
    {
        $nickname = $request->get('nickname');
        $test = User::where('nickname', "=",$nickname)->get();
        if($test->first() === null)
        {
            $user = User::find(Auth::user()->id);
            $user->nickname = $nickname;
            $user->save();
            Mail::to($user->email)->send(new \App\Mail\NewUserSignUp($user));
            return redirect('logged');
        }
        else
        {
            return redirect('nickname')->withErrors(['Nickname Already exist']);
        }
    }
    public function UserLogout(){
        Auth::logout();
        return redirect('/');
    }
}

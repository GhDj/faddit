<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Socialite;
use App\User;
use App\SocialAccounts;
use Auth;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param $driver
     * @return Response
     *
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param $driver
     * @return Response
     */
    public function handleProviderCallback()
    {
        $driver = 'facebook';
        $user = Socialite::driver('facebook')->user();
        $local_user = SocialAccounts::where('driver', '=', 'facebook')->where('driver_id', '=', $user->id)->first();
        $user_data = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => str_random(40),
            'nickname' => ''
        ];


        if($local_user === null)
        {
            $current_user = User::firstOrCreate($user_data);
            $social_data = [
                'user_id' => $current_user->id,
                'driver' => $driver,
                'driver_id' => $user->id,
                'fullobj' => json_encode($user)
            ];
            SocialAccounts::firstOrCreate($social_data);
            Auth::login($current_user);
            return redirect('nickname');
        }
        else
        {
            Auth::login($local_user->user);
            if($local_user->nickname === "")
            {
                return redirect('nickname');
            }
        }

        return redirect('');
    }

    public function LoginView(){
        return view('auth.login');
    }
}

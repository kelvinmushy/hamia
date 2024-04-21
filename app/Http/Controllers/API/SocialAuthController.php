<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    //

    public function redirectToProvider(){

            return Socialite::driver('google')->redirect();
    }

    public function handleCallback(){
        
        $user=Socialite::driver('google')->stateless()->user();

       $this-> _registerOrLogin($user);

       return redirect()->route('agent.dashboard');
         

    }
    protected function _registerOrLogin($data){

        $user=User::where('email','=',$data->email)->first();
       
        if(!$user){
           
            $user=new User();
            $user->name=$data->name;
            $user->username=$data->name;
            $user->email=$data->email;
            $user->google_id=$data->id;
            $user->role_id='2';
            $user->save();

        }
        Auth::login($user);
    }
}

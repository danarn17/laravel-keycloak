<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SSOController extends Controller
{

    public function redirectToProvider(){
        return Socialite::driver("keycloak")->redirect();
    }
    public function handleProviderCallback(Request $request)
    {
        $user=Socialite::driver("keycloak")->user();
        $accessToken = $user->accessTokenResponseBody;
        $findUser = User::where("ref_id", $user->id)->first();
        if($findUser->count() > 0){
            $findUser->update([
                "kc_access_token"=> $accessToken['access_token'],
                "kc_refresh_token"=> $accessToken['refresh_token'],
                "kc_access_token_expiration"=> Carbon::now()->addSeconds($accessToken['expires_in']),
                "kc_refresh_token_expiration"=> Carbon::now()->addSeconds($accessToken['refresh_expires_in']),
            ]);
            Auth::login($findUser);
            return redirect('/dashboard');
        }else{
            echo "Tidak Ada Akses";
        }
        dump($user);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\User;
use App\Models\Role;

class SocialController extends Controller
{
  public function redirectToProvider($provider)
{
return Socialite::driver($provider)->redirect();
}
public function handleProviderCallback($provider)
{
$user = Socialite::driver($provider)->user();
dd($user); //test dump menampilkan data user facebook.
}

}

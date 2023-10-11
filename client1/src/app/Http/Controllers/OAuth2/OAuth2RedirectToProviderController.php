<?php

namespace App\Http\Controllers\OAuth2;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class OAuth2RedirectToProviderController extends Controller
{

    public function __invoke()
    {
        return Socialite::driver('oauth2')->redirect();
    }
}

<?php

namespace App\Http\Controllers\OAuth2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuth2HandleProviderCallbackController extends Controller
{

    public function __invoke(Request $request)
    {
        try {
            $OAuth2User = Socialite::driver('oauth2')->user();
//            dd($OAuth2User);

            $user = User::query()->updateOrCreate([
                'id' => $OAuth2User->getId()
            ], [
                'id' => $OAuth2User->getId(),
                'email' => $OAuth2User->getEmail(),
                'name' => $OAuth2User->getName()
            ]);

            if (!$user) {
                return redirect('login');
            }

            Auth::login($user);
            $request->session()->put('access_token', $OAuth2User->token);
            $request->session()->put('refresh_token', $OAuth2User->refreshToken);
            $request->session()->put('expire_at', now()->addSeconds($OAuth2User->expiresIn));

            return redirect(route('home'));
        } catch (\Throwable $exception) {
            dd($exception);
            return redirect('login');
        }
    }
}

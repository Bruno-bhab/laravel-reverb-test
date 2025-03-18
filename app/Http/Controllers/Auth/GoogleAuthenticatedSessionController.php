<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthenticatedSessionController extends Controller
{
    public function callProvider(Request $request):RedirectResponse{
        return Socialite::driver('google')->redirect();
    }

    public function callbackProvider(Request $request):RedirectResponse{
        $googleUser = Socialite::driver('google')->user();

        $userNewPassword = generateRandomPassword(20);

        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'password' => $userNewPassword,
        ]);

        Auth::login($user);
        return redirect(getInitialAppPage());
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Events\AuthenticatedEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectTo(string $driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleCallback(string $driver)
    {
        $user = Socialite::driver($driver)->user();

        $existingUser = User::where('email', $user->email)->first();

        if (! $existingUser) {
            return redirect()->route('login')
                ->with('error', 'Only existing users can use this feature. Please use the same email currently registered.');
        }

        // if the existing user has no google id
        // set it
        if (! $existingUser->google_id) {
            $existingUser->update([
                'google_id' => $existingUser->id,
            ]);
        }

        $existingUser->update([
            'avatar' =>  $existingUser->avatar,
        ]);

        Auth::login($existingUser);

        return redirect()->route(RouteServiceProvider::HOME);
    }
}

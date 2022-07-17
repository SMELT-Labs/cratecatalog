<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

$providers = collect(config('socialite'));

Route::get('/oauth/redirect/{provider}', function ($provider) use ($providers) {
    abort_unless($providers->has($provider), 404);
    session()->flash('login-referrer', request()->headers->get('referer'));
    return Socialite::driver($provider)->redirect();
});

Route::any('/oauth/callback/{provider}', function ($provider) use ($providers) {
    abort_unless($providers->has($provider), 404);
    $social = Socialite::driver($provider)->user();

//    dd($social);

    $user = null;

    if (auth()->guest()) {
        $s = \App\Models\Social::where('service', $provider)
            ->where('identifier', $social->getId())
            ->first();

        if (!empty($s) && !empty($s->item)) {
            $user = $s->item;
        } else {
            $user = \App\Models\User::firstOrNew([
                "email" => $social->getEmail(),
                "name" => $social->getName() ?? $social->getEmail(),
            ]);

            $user->password = bcrypt(\Illuminate\Support\Str::random());
            $user->save();
        }
    } else {
        $user = auth()->user();
    }

//    if (auth()->check()) {


        $user->sociables()->updateOrCreate([
            "service" => $provider
        ], [
            "identifier" => $social->getId(),
            "name" => $social->getName(),
            "username" => $social->getNickname(),
            "email" => $social->getEmail(),
            "avatar" => $social->getAvatar(),
            "user" => json_encode($social->user)
        ]);
//    }
//    else {
//        $s = \App\Models\Social::where('service', $provider)
//            ->where('identifier', $social->getId())
//            ->first();
//        if (!empty($s) && !empty($s->item)) {
//            $user = $s->item;
//        } else {
//            $user = \App\Models\User::firstOrCreate([
//                "email" => $social->getEmail(),
//                "name" => $social->getName(),
//            ]);
//
//            $s = new \App\Models\Social();
//            $s->identifier = $social->getId();
//            $s->name = $social->getName();
//            $s->username = $social->getNickname();
//            $s->email = $social->getEmail();
//            $s->avatar = $social->getAvatar();
//            $s->user = $social->user;
//
//            $user->password = bcrypt(\Illuminate\Support\Str::random());
//            $user->sociables()->save($s);
//        }
//        dd($user);
//    }

    Auth::login($user);

    return redirect(session()->get('login-referrer', \route(config('navigation.home'))));
})->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

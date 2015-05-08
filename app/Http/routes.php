<?php

use App\User;

Route::get('/', function () {
    return view('welcome');
});

// Dummy route to create and login a user.
get('login', function() {
    User::truncate();

    $user = User::create([
        'name' => 'JohnDoe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'plan' => 'monthly'
    ]);

    Auth::login($user);

    return redirect('/');
});

// App\Http\Middleware\MustBeSubscribed
Route::get('test', ['middleware' => 'subscribed:monthly', function() {
    return 'Only show to those who are monthly members';
}]);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
// });


// Web

Route::middleware(['auth'])->group(function () {
    Route::GET('/', [PostController::class, 'index'])->name('posts.index');
    Route::GET('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::GET('/posts/archive', [PostController::class, 'archive'])->name('posts.archive');
    Route::POST('/posts/{post}', [PostController::class, 'restore'])->name('posts.restore');

    Route::GET('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::POST('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::GET('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::GET('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::PUT('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::DELETE('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});


// API
Auth::routes();




// for github

Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();

    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user);
    return redirect('/');
});




// for google

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/google/callback', function () {

    try {
        $user = Socialite::driver('google')->user();

        $finduser = User::where('google_id', $user->id)->first();

        if ($finduser) {
            Auth::login($finduser);
            return redirect('/');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => encrypt('123456dummy')
            ]);

            Auth::login($newUser);
            return redirect('/');
            // return redirect()->intended('dashboard');
        }
    } catch (Exception $e) {
        dd($e->getMessage());
    }
});

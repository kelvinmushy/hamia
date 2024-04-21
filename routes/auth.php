
<?php

use Illuminate\Support\Facades\Route;
Auth::routes();



Route::middleware('guest')->group(function(){

Route::get('/login-google',[App\Http\Controllers\API\SocialAuthController::class,'redirectToProvider'])->name('google.login');


Route::get('/auth/google/callback',[App\Http\Controllers\API\SocialAuthController::class,'handleCallback'])->name('google.login.callback');

});
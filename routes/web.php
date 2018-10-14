<?php

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
////// FORCE HTTPS ON LIVE //////////////////
if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}
/////////////////////////////////////////////

use Soundboard\sample;
use Soundboard\meme;
use Soundboard\bottomgif;
use Soundboard\Background;


// PUBLIC ROUTES

Route::get('/', function () {
    $samples = sample::getEnabled();
    $randomMeme = meme::getRandomMeme();
    $bottomGif = bottomgif::getRandomGif();
    $background = Background::getCurrent();
    return view('soundboard', compact('samples','randomMeme','bottomGif', 'background'));
});


Route::get('/samples/show/{sample}', 'SamplesController@show');


Route::get('/about', function () {
    return view('about');
});

Route::get('/bingo', function () {
    return view('bingo.katieBingo');
});

Route::get('/haliBingo', function () {
    return view('bingo.haliBingo');
});


Route::get('/home', 'HomeController@index')->name('home');

// SAMPLES
Route::get('/samples/manage', 'SamplesController@manageIndex')->middleware('auth');

Route::get('/samples/create', 'SamplesController@create')->middleware('auth')->name('MakeSample');

Route::get('/samples/edit/{id}', 'SamplesController@edit')->middleware('auth');

//Create
Route::post('/samples', 'SamplesController@store')->middleware('auth');

//Update
Route::patch('/samples/edit/{id}', 'SamplesController@patch')->middleware('auth');

//Delete
Route::delete('/samples/delete/', 'SamplesController@destroy')->middleware('auth');


//// Memes
Route::get('/memes/manage', 'MemeController@index')->middleware('auth')->name('ManageMemes');

//get Creation form
Route::get('/memes/create', 'MemeController@create')->middleware('auth')->name('MakeMeme');
//Create
Route::post('/memes', 'MemeController@store')->middleware('auth')->name('StoreMeme');

//Get Edit form
Route::get('/memes/edit/{id}', 'MemeController@edit')->middleware('auth')->name('EditMeme');
//Update
Route::patch('/memes/edit/{id}', 'MemeController@update')->middleware('auth');

//Delete
Route::delete('/memes/delete/', 'MemeController@destroy')->middleware('auth');


////Gifs
Route::get('/gifs/manage', 'GifController@index')->middleware('auth')->name('ManageGifs');

Route::get('/gifs/create', 'GifController@create')->middleware('auth')->name('UploadGif');

Route::post('/gifs', 'GifController@store')->middleware('auth')->name('StoreGif');
//Delete
Route::delete('/gifs/delete/', 'MemeController@destroy')->middleware('auth');

//Get Edit form
Route::get('/gifs/edit/{id}', 'GifController@edit')->middleware('auth')->name('EditGif');
//Update
Route::patch('/gifs/edit/{id}', 'GifController@update')->middleware('auth');

////Background Image
Route::get('/background/manage', 'BackgroundController@index')->middleware('auth')->name('ManageBackground');

Route::get('/background/create', 'BackgroundController@create')->middleware('auth')->name('UploadBackground');

Route::post('/background', 'BackgroundController@store')->middleware('auth')->name('StoreBackground');

Route::get('/background/edit/{id}', 'BackgroundController@edit')->middleware('auth');

Route::patch('/background/edit/{id}', 'BackgroundController@update')->middleware('auth');

Route::patch('/background/edit', 'BackgroundController@updateCurrent')->middleware('auth');


//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');




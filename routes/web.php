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

use Illuminate\Support\Facades\URL;
use App\sample;
use App\meme;
use App\bottomgif;
use App\Background;
// PUBLIC ROUTES

Route::get('/', 'mainController@soundboard')->name('main');
Route::get('/bingo', 'mainController@bingo')->name('bingo');
Route::get('/haliBingo', 'mainController@halibingo')->name('haliBingo');
Route::get('/about', 'mainController@about')->name('about');


Route::get('/samples/show/{sample}', 'SamplesController@show')->name('showSample');


Route::get('/home', 'HomeController@index')->name('home');

// SAMPLES
Route::group(['prefix' => 'samples'], function () {
    Route::get('/manage', 'SamplesController@manageIndex')->middleware('auth')->name('manageSample');
    Route::get('/create', 'SamplesController@create')->middleware('auth')->name('MakeSample');
    Route::get('/edit/{id}', 'SamplesController@edit')->middleware('auth')->name('editSample');
    //Create
    Route::post('/', 'SamplesController@store')->middleware('auth')->name('storeSample');
    //Update
    Route::patch('/edit/{id}', 'SamplesController@patch')->middleware('auth');
    //Delete
    Route::delete('/delete/', 'SamplesController@destroy')->middleware('auth')->name('deleteSample');
    Route::post('/manageUnused', 'SamplesController@manageUnused')->middleware('auth')->name('manageUnusedSamples');
    Route::delete('/manageUnused/', 'SamplesController@deleteUnused')->middleware('auth');
});
//// Memes
Route::group(['prefix' => 'memes'], function () {
    Route::get('manage', 'MemeController@index')->middleware('auth')->name('ManageMemes');
//get Creation form
    Route::get('/create', 'MemeController@create')->middleware('auth')->name('MakeMeme');
//Create
    Route::post('/', 'MemeController@store')->middleware('auth')->name('StoreMeme');
//Get Edit form
    Route::get('/edit/{id}', 'MemeController@edit')->middleware('auth')->name('EditMeme');
//Update
    Route::patch('/edit/{id}', 'MemeController@update')->middleware('auth');
//Delete
    Route::delete('/delete/', 'MemeController@destroy')->middleware('auth')->name('DeleteMeme');
});
////Gifs
Route::group(['prefix' => 'gifs'], function () {
    Route::get('manage', 'GifController@index')->middleware('auth')->name('ManageGifs');

    Route::get('create', 'GifController@create')->middleware('auth')->name('UploadGif');

    Route::post('/', 'GifController@store')->middleware('auth')->name('StoreGif');
//Delete
    Route::delete('delete', 'GifController@destroy')->middleware('auth')->name('DeleteGif');

//Get Edit form
    Route::get('edit/{id}', 'GifController@edit')->middleware('auth')->name('EditGif');
//Update
    Route::patch('edit/{id}', 'GifController@update')->middleware('auth');

    Route::post('manageUnused', 'GifController@manageUnused')->middleware('auth')->name('ManageUnusedGifs');

    Route::delete('manageUnused', 'GifController@deleteUnused')->middleware('auth');
});
////Background Image
Route::group(['prefix' => 'background'] , function (){
Route::get('/manage', 'BackgroundController@index')->middleware('auth')->name('ManageBackground');

Route::get('/create', 'BackgroundController@create')->middleware('auth')->name('UploadBackground');

Route::post('/', 'BackgroundController@store')->middleware('auth')->name('StoreBackground');

Route::get('edit/{id}', 'BackgroundController@edit')->middleware('auth')->name('EditBackground');

Route::patch('edit/{id}', 'BackgroundController@update')->middleware('auth');

Route::delete('delete', 'BackgroundController@destroy')->middleware('auth')->name('DeleteBackground');

Route::patch('updateCurrent', 'BackgroundController@updateCurrent')->middleware('auth')->name('UpdateBackground');

Route::post('manageUnused', 'BackgroundController@manageUnused')->middleware('auth')->name('ManageUnusedBackgrounds');

Route::delete('manageUnused/', 'BackgroundController@deleteUnused')->middleware('auth');
});
///User
Route::group(['prefix' => 'user'] , function (){
    Route::get('manage', 'UserController@index')->middleware('auth')->name('ManageUser');
    Route::get('create', 'UserController@create')->middleware('auth')->name('AddUser');
    Route::post('create', 'UserController@store')->middleware('auth');
    Route::get('/edit/{id}', 'UserController@edit')->middleware('auth')->name('EditUser');
    Route::post('/edit/{id}', 'UserController@update')->middleware('auth');
    Route::delete('/delete/{id}', 'UserController@destroy')->middleware('auth')->name('DeleteUser');
});

Route::group(['prefix' => 'bingo'] , function (){
    Route::get('/manage', 'BingoController@index')->middleware('auth')->name('ManageBingo');
    Route::get('/create', 'BingoController@create')->middleware('auth')->name('AddBingo');
    Route::post('/create', 'BingoController@store')->middleware('auth');
    Route::get('/edit/{id}', 'BingoController@edit')->middleware('auth')->name('EditBingo');
    Route::patch('/edit/{id}', 'BingoController@update')->middleware('auth');
    Route::delete('/delete/{id}', 'BingoController@destroy')->middleware('auth');
});


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

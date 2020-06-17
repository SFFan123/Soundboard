<?php

namespace App\Http\Controllers;

use App\Background;
use App\bottomgif;
use App\meme;
use App\sample;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $samples = sample::all();
        $memes = meme::all();
        $gifs = bottomgif::all();
        $Backgrounds = Background::all();
        $User = User::all()->count();
        return view('home', compact('samples','memes','gifs', 'Backgrounds', 'User'));
    }
}

<?php

namespace Soundboard\Http\Controllers;

use Soundboard\sample;
use Soundboard\meme;
use Soundboard\bottomgif;
use Soundboard\Background;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $samples = sample::all();
        $memes = meme::all();
        $gifs = bottomgif::all();
        $Backgrounds = Background::all();
        return view('home', compact('samples','memes','gifs', 'Backgrounds'));
    }
}

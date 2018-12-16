<?php

namespace Soundboard\Http\Controllers;

use Illuminate\Http\Request;
use Soundboard\Background;
use Soundboard\bottomgif;
use Soundboard\meme;
use Soundboard\sample;

class mainController extends Controller
{
    public function index()
    {
        try{
            $samples = sample::getEnabled();
            $randomMeme = meme::getRandomMeme();
            $bottomGif = bottomgif::getRandomGif();
            $background = Background::getCurrent();
            return view('soundboard', compact('samples','randomMeme','bottomGif', 'background'));
        }
        catch (\Illuminate\Database\QueryException $exception)
        {
            abort(500.12, 'Database not reachable.');
        }
    }
}

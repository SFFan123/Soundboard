<?php

namespace Soundboard\Http\Controllers;

use Illuminate\Http\Request;
use Soundboard\Background;
use Soundboard\BingoPhrase;
use Soundboard\bottomgif;
use Soundboard\meme;
use Soundboard\sample;

class mainController extends Controller
{
    public function soundboard()
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
    public function bingo()
    {
        try
        {
            $background = Background::getCurrent();
            $tiles = ['Bla', 'xD', 'phi', 'foo', 'bar', 'Bla', 'xD', 'phi', 'foo', 'bar', 'Bla', 'xD', 'Katie is a dork', 'foo', 'bar', 'Bla', 'xD', 'phi', 'foo', 'bar', 'Bla', 'xD', 'phi', 'foo', 'bar'];
            shuffle($tiles);
            if(count($tiles)<25)
            {
                $tiles = null;
            }
        }
        catch (\Illuminate\Database\QueryException $e)
        {}
        return view('bingo.katieBingo', compact('background', 'tiles'));

    }
    public function about()
    {
        return view('about');
    }
    public function halibingo()
    {
        abort(500.12, 'Function not yet implemented');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meme extends Model
{
    public static function getRandomMeme()
    {
        return static::where('enabled', 1)->inRandomOrder()->first();
    }
    public static function count()
    {
    	return static::all()->count();
    }



    protected $fillable = ['memeName', 'memeText', 'clipboardText' , 'enabled'];
}

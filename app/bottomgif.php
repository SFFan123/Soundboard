<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bottomgif extends Model
{
    public static function getRandomGif()
    {
    	return static::where('enabled', 1)->inRandomOrder()->first();
    }
    public static function count()
    {
        return static::all()->count();
    }
    public static function countEnabled()
    {
        return static::where('enabled', 1)->count();
    }

    protected $fillable = ['filename', 'GifName', 'enabled', 'placement'];
}

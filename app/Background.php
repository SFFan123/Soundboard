<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\activeBackground;

class Background extends Model
{

    //
    public static function count()
    {
        return static::all()->count();
    }

    public static function getCurrent()
    {
        return static::where('id', activeBackground::getActiveID())->first();
    }

    protected $fillable = ['name', 'filename', 'enabled' , 'active'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activeBackground extends Model
{

    public static function getActiveID()
    {
        if(static::all()->count() == 0)
        {
            return -1;
        }
        else
        {
            return static::first()->background_id;
        }

    }
    public static function getActive()
    {
        return static::first();
    }


    protected $fillable = ['background_id'];
}

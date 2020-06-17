<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sample extends Model
{

    public static function count()
    {
        return static::all()->count();
    }

    public static function getEnabled()
    {
        return static::where('enabled', 1)->get();
    }

    protected $fillable = ['filename', 'name', 'display' ,'subsound', 'enabled'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BingoPhrase extends Model
{
    public static function count()
    {
        return static::all()->count();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function getAllPublishers()
    {
        return self::all();
    }

    public static function getAllPublishersIds()
    {
        return self::query()->get()->pluck('id')->toArray();
    }
}

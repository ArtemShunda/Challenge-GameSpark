<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'image_path',
        'platform',
        'genre',
        'release_year',
        'status',
        'rating',
    ];
}

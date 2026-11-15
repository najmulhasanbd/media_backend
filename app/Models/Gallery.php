<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $guarded = ['id'];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];
}

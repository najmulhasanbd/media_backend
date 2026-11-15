<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShootingHouse extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'boolean',
    ];
}

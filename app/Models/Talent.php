<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Talent extends Model
{
    protected $table = 'talents';

    protected $guarded = ['id'];

    protected $casts = [
        'is_international' => 'boolean',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

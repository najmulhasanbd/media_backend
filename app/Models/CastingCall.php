<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CastingCall extends Model
{
    protected $guarded = ['id'];

    /**
     * Get safe formatted deadline or fallback to raw string.
     */
    public function getFormattedDeadlineAttribute(): ?string
    {
        if (empty($this->deadline)) {
            return null;
        }

        try {
            return Carbon::parse($this->deadline)->format('d M');
        } catch (\Throwable $e) {
            return (string) $this->deadline;
        }
    }
}

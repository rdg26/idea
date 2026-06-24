<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdeaImage extends Model
{
    protected $fillable = [
        'path',
    ];

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
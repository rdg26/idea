<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['description'])]
class Step extends Model
{
    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Models;

// use App\IdeaStatus;
use App\IdeaStatus;
use Database\Factories\IdeaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\IdeaLike;
use App\Models\IdeaImage;

#[Fillable([
    'title',
    'description',
    'links',
    'status',
])]
class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;

    protected $casts = [
        //'links' => AsArrayObject::class,
        'links' => 'array',
        'status' => IdeaStatus::class,
    ];

    protected $attributes = [
        'status' => IdeaStatus::PENDING->value,
    ];

    public static function statusCounts(): SupportCollection
    {
        // /select status, count(*) from ideas group by status
        $counts = self::query()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return collect(IdeaStatus::cases())
            ->mapWithKeys(fn ($status) => [
                $status->value => $counts->get($status->value, 0),
            ])
            ->put('all', self::count());

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    public function likes()
    {
        return $this->hasMany(IdeaLike::class);
    }

    public function images()
    {
        return $this->hasMany(IdeaImage::class);
    }

    public function allImages()
    {
        return $this->images;
    }
}

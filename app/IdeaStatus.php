<?php

declare(strict_types=1);

namespace App;

enum IdeaStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
        {
            return __('status.' . $this->value);
        }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

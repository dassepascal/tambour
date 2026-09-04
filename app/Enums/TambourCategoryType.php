<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TambourCategoryType: string implements HasLabel
{
    case Tambour = 'tambour';
    case Accessoire = 'accessoire';

    public function getLabel(): string
    {
        return match ($this) {
            self::Tambour => 'Tambour',
            self::Accessoire => 'Accessoire',
        };
    }
}

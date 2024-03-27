<?php

namespace App\enum;

use Illuminate\Support\Facades\Lang;

enum ButtonType : string
{
    case RED = 'red';
    case GREEN = 'green';
    case BLUE = 'blue';

    public function getClass(): string
    {
        $standardButton = 'px-4 py-2 rounded-md text-white';

        return match ($this->value) {
            self::RED => $standardButton . ' bg-red-500',
            self::GREEN => $standardButton . ' bg-green-500',
            default => $standardButton . ' bg-blue-500',
        };
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Shared;

class AdvertisementDescriptionWordsClave
{

    public const BRIGHT = 'Luminoso';
    public const NEW = 'Nuevo';
    public const CENTER = 'Céntrico';
    public const RENOVATED = 'Reformado';
    public const PENTHOUSE = 'Ático';


    /**
     * @return array<string>
     */
    public static function getWordsClave(): array
    {
        return [
            self::BRIGHT,
            self::NEW,
            self::CENTER,
            self::RENOVATED,
            self::PENTHOUSE,
        ];
    }
}
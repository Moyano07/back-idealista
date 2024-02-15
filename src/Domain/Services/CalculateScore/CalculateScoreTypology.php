<?php

declare(strict_types=1);

namespace App\Domain\Services\CalculateScore;


use App\Domain\Shared\AdvertisementTypologyTypeEnum;

class CalculateScoreTypology
{
    const CHALET = 20;
    const FLAT = 10;
    const GARAGE = 0;


    public function calculateScore(string $typology): int
    {
        return match ($typology) {
            AdvertisementTypologyTypeEnum::CHALET => self::CHALET,
            AdvertisementTypologyTypeEnum::FLAT => self::FLAT,
            AdvertisementTypologyTypeEnum::GARAGE => self::GARAGE,
            default => 0,
        };
    }

}
<?php

declare(strict_types=1);

namespace App\Domain\Services\CalculateScore;

use App\Domain\Picture;
use App\Domain\Shared\PictureQualityValueEnum;

class CalculateScorePictures
{

    const EMPTY_PICTURES = -10;
    const HD = 20;
    const SD = 10;

    public function calculateScore(array $pictures): int
    {
        $score = 0;
        if (empty($pictures)) {
            return self::EMPTY_PICTURES;
        }

        /** @var Picture $picture */
        foreach ($pictures as $picture) {
            $score = $score + match ($picture->getQuality()) {
                PictureQualityValueEnum::QUALITY_HD => self::HD,
                PictureQualityValueEnum::QUALITY_SD => self::SD,
                default => 0,
            };
        }

        return $score;
    }
}
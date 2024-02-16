<?php

declare(strict_types=1);

namespace App\Tests\Utils;


use App\Domain\Picture;
use App\Domain\Shared\PictureQualityValueEnum;
use Faker\Factory;

class PicturesFixtures
{

    public static function createPicturesByNumber(int $count): array
    {
        $faker = Factory::create();
        $pictures = [];
        for ($i = 1; $i <= $count; ++$i) {
            $quality = self::getQualityTypes();
           $pictures[]  =  new Picture(
               id: $faker->randomDigitNotNull(),
               url: $faker->imageUrl(),
               quality: $quality[$faker->numberBetween(0,1)]
           );
        }

        return $pictures;
    }

    private static function getQualityTypes(): array
    {
            return [
                PictureQualityValueEnum::QUALITY_HD,
                PictureQualityValueEnum::QUALITY_SD,

            ];

    }
}
<?php

declare(strict_types=1);

namespace App\Tests\Utils;

use App\Domain\Ad;
use App\Domain\Shared\AdvertisementTypologyTypeEnum;
use App\Tests\Utils\PicturesFixtures;
use Faker\Factory;

class AdvertisementFixtures
{

    public static function createAdvertisementsByNumberToCalculateScore(int $count): array
    {
        $faker = Factory::create();
        $ads = [];
        for ($i = 1; $i <= $count; ++$i) {
            $pictures = PicturesFixtures::createPicturesByNumber($faker->numberBetween(0,3));
            $ads [] = new Ad(
                id: $faker->randomDigitNotNull(),
                typology: AdvertisementTypologyTypeEnum::FLAT,
                description: $faker->realTextBetween(10,250),
                pictures: $pictures,
                houseSize: $faker->randomDigitNotNull(),
                gardenSize: $count % 2 ? $faker->randomDigit() : null,
                score: null,
                irrelevantSince: null
            );
        }

        return $ads;
    }

}
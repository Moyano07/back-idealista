<?php

declare(strict_types=1);

namespace App\Tests\Utils;

class PublicListFixtures
{
    const ID ='id' ;
    const TYPOLOGY ='typology' ;
    const DESCRIPTION = 'description';
    const PICTURES_URLS = 'pictureUrls';
    const HOUSE_SIZE = 'houseSize';
    const GARDEN_SIZE = 'gardenSize';

    public static function getAllProperties(): array
    {
        return [
            self::ID,
            self::TYPOLOGY,
            self::DESCRIPTION,
            self::PICTURES_URLS,
            self::HOUSE_SIZE,
            self::GARDEN_SIZE,
        ];
    }
}
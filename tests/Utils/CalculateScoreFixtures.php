<?php

declare(strict_types=1);

namespace App\Tests\Utils;

class CalculateScoreFixtures
{

    const ID ='id' ;
    const TYPOLOGY ='typology' ;
    const DESCRIPTION = 'description';
    const PICTURES = 'pictures';
    const HOUSE_SIZE = 'houseSize';
    const GARDEN_SIZE = 'gardenSize';
    const SCORE = 'score';

    public static function getAllProperties(): array
    {
        return [
            self::ID,
            self::TYPOLOGY,
            self::DESCRIPTION,
            self::PICTURES,
            self::HOUSE_SIZE,
            self::GARDEN_SIZE,
            self::SCORE,
        ];
    }
}
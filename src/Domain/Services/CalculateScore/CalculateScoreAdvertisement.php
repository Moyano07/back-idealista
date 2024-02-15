<?php

declare(strict_types=1);

namespace App\Domain\Services\CalculateScore;

use App\Domain\Ad;
use App\Domain\Shared\AdvertisementTypologyTypeEnum;

class CalculateScoreAdvertisement
{
    const INIT_SCORE = 0;
    const PLUS_WITH_ADVERTISEMENT_COMPLETE = 40;

    public function __construct
    (
        private CalculateScoreDescription $calculateScoreDescription,
        private CalculateScoreTypology    $calculateScoreTypology,
        private CalculateScorePictures    $calculateScorePictures
    )
    {
    }

    public function execute(Ad $advertisement):void
    {
        $score = self::INIT_SCORE;
        $score = $score + $this->calculateScoreDescription->calculateScore($advertisement->getDescription(), $advertisement->getTypology());
        $score = $score + $this->calculateScoreTypology->calculateScore($advertisement->getTypology());
        $score = $score + $this->calculateScorePictures->calculateScore($advertisement->getPictures());

        $score = self::isAdvertisementComplete(
                    $advertisement->getTypology(),
                    $advertisement->getDescription(),
                    $advertisement->getPictures(),
                    $advertisement->getHouseSize(),
                    $advertisement->getGardenSize(),
                ) ? $score + self::PLUS_WITH_ADVERTISEMENT_COMPLETE : $score;

        $advertisement->setScore($score);
    }


    private static function isAdvertisementComplete(string $typology, string $description, array $listPictures, int $houseSize, ?int $gardenSize): bool
    {
        if (empty($description) && $typology !== AdvertisementTypologyTypeEnum::GARAGE) {
            return false;
        }

        if (count($listPictures) === 0) {
            return false;
        }
        if ($houseSize === 0) {
            return false;
        }
        if ($typology === AdvertisementTypologyTypeEnum::CHALET) {
            if (is_null($gardenSize)) {
                return false;
            }
        }

        return true;
    }

}
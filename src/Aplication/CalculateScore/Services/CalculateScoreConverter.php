<?php

declare(strict_types=1);

namespace App\Aplication\CalculateScore\Services;

use App\Domain\Ad;
use App\Infrastructure\Api\CalculateScoreAd;

class CalculateScoreConverter
{

    public function converter(array $data): array
    {
        $dataResponse= [];
        /** @var Ad $ad */
        foreach ($data as $ad) {
            $res = new CalculateScoreAd(
                id: $ad->getId(), typology: $ad->getTypology(), description: $ad->getDescription(), pictures: $ad->getPictures(), houseSize: $ad->getHouseSize(),gardenSize: $ad->getGardenSize(),score: $ad->getScore()
            );

            $dataResponse[] = $res->jsonSerialize();

        }

        return $dataResponse;
    }
}
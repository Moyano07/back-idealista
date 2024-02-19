<?php

declare(strict_types=1);

namespace App\Aplication\QualityAdList\Services;

use App\Domain\Ad;
use App\Domain\Picture;
use App\Infrastructure\Api\QualityAd;

class QualityAdConverter
{

    public function convert(array $data): array
    {
        $qualities = [];
        /** @var Ad $advertisement */
        foreach ($data as $advertisement) {
            $qualityAd =  new QualityAd(id: $advertisement->getId(),
                typology: $advertisement->getTypology(),
                description: $advertisement->getDescription(),
                pictureUrls: $this->filterUrls($advertisement->getPictures()),
                houseSize: $advertisement->getHouseSize(),
                gardenSize: $advertisement->getGardenSize(),
                score: $advertisement->getScore(),
                irrelevantSince: $advertisement->getIrrelevantSince()
            );
            $qualities[] = $qualityAd->jsonSerialize(); }

        return $qualities;
    }

    private function filterUrls(array $pictures): array
    {
        $data = [];
        /** @var Picture $picture */
        foreach ($pictures as $picture) {
            $data[] =  $picture->getUrl();
        }

        return $data;
    }
}
<?php

declare(strict_types=1);

namespace App\Aplication\PublicList\Services;

use App\Domain\Ad;
use App\Domain\Picture;
use App\Infrastructure\Api\PublicAd;

class PublicListConverter
{
    public function execute(array $advertisements): array
    {
        $data = [];
        /** @var Ad $advertisement */
        foreach ($advertisements as $advertisement){
            $publicAd = new PublicAd(
                id: $advertisement->getId(),
                typology: $advertisement->getTypology(),
                description: $advertisement->getDescription(),
                pictureUrls: $this->filterUrls($advertisement->getPictures()),
                houseSize: $advertisement->getHouseSize(),
                gardenSize: $advertisement->getGardenSize()
            );
            $data[] = $publicAd->jsonSerialize();
        }

        return $data;
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
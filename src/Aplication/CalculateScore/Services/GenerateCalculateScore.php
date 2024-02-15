<?php

declare(strict_types=1);

namespace App\Aplication\CalculateScore\Services;

use App\Domain\Ad;
use App\Domain\Services\CalculateScore\CalculateScoreAdvertisement;

class GenerateCalculateScore
{
    public function __construct
    (
        private CalculateScoreAdvertisement $calculateScoreAdvertisement
    )
    {
    }

    public function execute(array $data): array
    {
        /** @var Ad $ad */
        foreach ($data as $ad) {
            $this->calculateScoreAdvertisement->execute($ad);
        }

        return $data;
    }

}
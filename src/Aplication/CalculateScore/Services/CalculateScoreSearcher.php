<?php

declare(strict_types=1);

namespace App\Aplication\CalculateScore\Services;


use App\Domain\Repository\AdvertisementRepositoryInterface;

final class CalculateScoreSearcher
{


    public function __construct(private AdvertisementRepositoryInterface $advertisementRepository)
    {
    }

    public function searchAll(): array
    {
        return  $this->advertisementRepository->findAllAds();
    }
}
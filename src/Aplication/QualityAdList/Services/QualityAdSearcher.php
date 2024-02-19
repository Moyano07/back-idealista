<?php

declare(strict_types=1);

namespace App\Aplication\QualityAdList\Services;


use App\Domain\Repository\AdvertisementRepositoryInterface;

class QualityAdSearcher
{
    public function __construct(private AdvertisementRepositoryInterface $advertisementRepository)
    {
    }

    public function searchAll(): array
    {
        return  $this->advertisementRepository->findAllAds();
    }

}
<?php

declare(strict_types=1);

namespace App\Aplication\PublicList\Services;

use App\Domain\Repository\AdvertisementRepositoryInterface;

class PublicListSearcher
{
    public function __construct(private AdvertisementRepositoryInterface $advertisementRepository)
    {
    }

    public function searchAll(): array
    {
        return  $this->advertisementRepository->findAllAds();
    }
}
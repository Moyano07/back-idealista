<?php

declare(strict_types=1);

namespace App\Aplication\PublicList\Services;


use App\Domain\Services\PublicList\PublicListAdvertisementFilter;

class PublicListFilter
{

    public function __construct
    (
        private PublicListAdvertisementFilter $advertisementFilter
    )
    {
    }

    public function execute(array $data): array
    {
        return $this->advertisementFilter->execute($data);

    }

}
<?php

declare(strict_types=1);

namespace App\Domain\Services\PublicList;

use App\Domain\Ad;

class PublicListAdvertisementFilter
{

    const MIN_VALUE_SCORE_PUBLIC = 40;

    public function execute(array $advertisements): array
    {
       $data = [];

       /** @var Ad $ad */
        foreach ($advertisements as $ad ) {
           if ($ad->getScore() >= self::MIN_VALUE_SCORE_PUBLIC) {
               $data[] = $ad;
           }
       }
        usort($data, function (Ad $a, Ad $b) {
            return $b->getScore() - $a->getScore();
        });

        return $data;
    }
}
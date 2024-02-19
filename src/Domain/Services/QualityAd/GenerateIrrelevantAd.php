<?php

declare(strict_types=1);

namespace  App\Domain\Services\QualityAd;

use App\Domain\Ad;

class GenerateIrrelevantAd
{
    const MIN_SCORE_FOR_IRRELEVANT = 40;

    public function execute(array $data): array
    {
        /** @var Ad $ad */
        foreach ($data as $ad) {
            if ($ad->getScore() < self::MIN_SCORE_FOR_IRRELEVANT) {
                $ad->setIrrelevantSince(new \DateTimeImmutable());
            }
        }

        return $data;
    }

}
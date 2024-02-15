<?php

declare(strict_types=1);

namespace App\Aplication\QualityAdList;

use App\Aplication\QualityAdList\Services\QualityAdConverter;
use App\Aplication\QualityAdList\Services\QualityAdSearcher;
use App\Aplication\Shared\GenerateCalculateScore;
use App\Domain\Services\QualityAd\GenerateIrrelevantAd;

class QualityAdListUseCase
{


    public function __construct
    (
        private QualityAdSearcher $qualityAdSearcher,
        private GenerateCalculateScore $calculateScore,
        private GenerateIrrelevantAd $generateIrrelevantAd,
        private QualityAdConverter $converter
    )
    {
    }

    public function __invoke(): array
    {
        $data = $this->qualityAdSearcher->searchAll();
        $dataWithScores = $this->calculateScore->execute(data: $data);

        $dataWithIrrelevantAds = $this->generateIrrelevantAd->execute($dataWithScores);

        return $this->converter->convert($dataWithIrrelevantAds);
    }
}
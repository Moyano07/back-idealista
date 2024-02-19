<?php

declare(strict_types=1);

namespace App\Aplication\CalculateScore;


use App\Aplication\CalculateScore\Services\CalculateScoreConverter;
use App\Aplication\CalculateScore\Services\CalculateScoreSearcher;
use App\Aplication\Shared\GenerateCalculateScore;

class CalculateScoreUseCase
{

    public function __construct
    (
        public CalculateScoreSearcher $calculateScoreSearcher ,
        private CalculateScoreConverter $calculateScoreConverter,
        private GenerateCalculateScore $generateCalculateScore
    )
    {
    }

    public function __invoke(): array
    {
        $data = $this->calculateScoreSearcher->searchAll();

        return $this->calculateScoreConverter->converter($this->generateCalculateScore->execute(data:$data));
    }

}
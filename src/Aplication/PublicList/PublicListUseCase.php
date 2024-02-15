<?php

declare(strict_types=1);

namespace App\Aplication\PublicList;

use App\Aplication\PublicList\Services\PublicListConverter;
use App\Aplication\PublicList\Services\PublicListFilter;
use App\Aplication\PublicList\Services\PublicListSearcher;
use App\Aplication\Shared\GenerateCalculateScore;

class PublicListUseCase
{

    public function __construct
    (
        private PublicListSearcher $searcher,
        private GenerateCalculateScore $generateCalculateScore,
        private PublicListFilter $filter,
        private PublicListConverter $converter
    )
    {
    }

    public function __invoke(): array
    {
        $data = $this->searcher->searchAll();
        $datWithScores = $this->generateCalculateScore->execute($data);

        return $this->converter->execute($this->filter->execute($datWithScores));
    }

}
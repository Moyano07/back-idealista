<?php

declare(strict_types=1);

namespace App\Domain\Services\CalculateScore;


use App\Domain\Shared\AdvertisementDescriptionWordsClave;
use App\Domain\Shared\AdvertisementTypologyTypeEnum;

class CalculateScoreDescription
{

    const EMPTY_DESCRIPTION = 0;
    const CONTENT_DESCRIPTION = 5;
    const DESCRIPTION_CONTENT_MIN_WORDS_IN_FLAT = 10;
    const DESCRIPTION_CONTENT_MIN_WORDS_IN_CHALET = 10;
    const DESCRIPTION_CONTENT_GET_OVER_MAX_WORDS_IN_FLAT = 30;

    const MIN_NUMBER_WORDS_FOR_CHALET = 50;
    const MIN_NUMBER_WORDS_FOR_FLAT = 20;
    const MAX_NUMBER_WORDS_FOR_FLAT = 49;
    const FIND_WORD_CLAVE = 5;

    public function calculateScore(string $description, string $typology): int
    {
        if (empty($description)) {
            return self::EMPTY_DESCRIPTION;
        }

        $score =  self::CONTENT_DESCRIPTION;

        $score = $score + match($typology) {
                AdvertisementTypologyTypeEnum::CHALET => $this->countWords($description) >= self::MIN_NUMBER_WORDS_FOR_CHALET ? self::DESCRIPTION_CONTENT_MIN_WORDS_IN_CHALET : 0,
                AdvertisementTypologyTypeEnum::FLAT => $this->calculateScoreByTypologyFlat($this->countWords($description)),
                default => 0
            };

        return  $score + $this->searchWordClave($description);
    }

    private function calculateScoreByTypologyFlat(int $countWords): int
    {
        $score = 0;
        if ($countWords < self::MIN_NUMBER_WORDS_FOR_FLAT) {
            return $score;
        }

        if ($countWords <= self::MAX_NUMBER_WORDS_FOR_FLAT) {
            return  self::DESCRIPTION_CONTENT_MIN_WORDS_IN_FLAT;
        }

        return self::DESCRIPTION_CONTENT_GET_OVER_MAX_WORDS_IN_FLAT;

    }

    private function searchWordClave(string $value): int
    {
        $score = 0;
        foreach (AdvertisementDescriptionWordsClave::getWordsClave() as $wordClave) {
            if (str_contains($value, $wordClave)) {
                $score = $score + self::FIND_WORD_CLAVE;
            }
        }

        return $score;
    }

    public function countWords(string $value): int
    {
        return str_word_count($value);
    }
}
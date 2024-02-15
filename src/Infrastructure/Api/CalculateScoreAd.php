<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

final class CalculateScoreAd implements \JsonSerializable
{

    public function __construct(
        private int $id,
        private String $typology,
        private String $description,
        private array $pictures,
        private int $houseSize,
        private ?int $gardenSize = null,
        private ?int $score = null
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' =>$this->id,
            'typology' => $this->typology,
            'description' => $this->description,
            'pictures' => $this->pictures,
            'houseSize' => $this->houseSize,
            'gardenSize' => $this->gardenSize,
            'score' => $this->score
        ];
    }
}
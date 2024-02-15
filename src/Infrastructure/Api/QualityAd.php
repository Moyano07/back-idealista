<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use DateTimeImmutable;

final class QualityAd implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private String $typology,
        private String $description,
        private array $pictureUrls,
        private int $houseSize,
        private ?int $gardenSize = null,
        private ?int $score = null,
        private ?DateTimeImmutable $irrelevantSince = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' =>$this->id,
            'typology' => $this->typology,
            'description' => $this->description,
            'pictureUrls' => $this->pictureUrls,
            'houseSize' => $this->houseSize,
            'gardenSize' => $this->gardenSize,
            'score' => $this->score,
            'irrelevantSince' => $this->irrelevantSince ? ($this->irrelevantSince)->format('Y-m-d') : null,
        ];
    }

}

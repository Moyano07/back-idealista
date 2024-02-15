<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

final class PublicAd implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private String $typology,
        private String $description,
        private array $pictureUrls,
        private int $houseSize,
        private ?int $gardenSize = null,
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
        ];
    }
}

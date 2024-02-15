<?php

declare(strict_types=1);

namespace App\Domain;

final class Picture
{
    public function __construct(
        public int $id,
        public String $url,
        public String $quality,
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getQuality(): string
    {
        return $this->quality;
    }


}

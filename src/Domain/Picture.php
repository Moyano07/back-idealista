<?php

declare(strict_types=1);

namespace App\Domain;

final class Picture
{
    public function __construct(
        private int $id,
        private String $url,
        private String $quality,
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

    /**
     * @return String
     */
    public function getUrl(): string
    {
        return $this->url;
    }


}

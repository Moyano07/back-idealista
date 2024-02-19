<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Aplication\PublicList\PublicListUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PublicListingController
{

    public function __construct(private PublicListUseCase $publicListUseCase)
    {
    }

    public function __invoke(): JsonResponse
    {
        $data = ($this->publicListUseCase)();

        return new JsonResponse($data);
    }
}

<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Aplication\QualityAdList\QualityAdListUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class QualityListingController
{

    public function __construct
    (
        private QualityAdListUseCase $useCase
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        $data = ($this->useCase)();

        return new JsonResponse($data);
    }
}

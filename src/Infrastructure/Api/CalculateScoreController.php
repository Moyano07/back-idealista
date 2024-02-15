<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Aplication\CalculateScore\CalculateScoreUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CalculateScoreController
{

    public function __construct(private CalculateScoreUseCase $calculateScoreUseCase)
    {
    }

    public function __invoke(): JsonResponse
    {
        $data = ($this->calculateScoreUseCase)();
        return new JsonResponse($data);
    }
}

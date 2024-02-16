<?php

declare(strict_types=1);

use App\Aplication\CalculateScore\CalculateScoreUseCase;
use App\Aplication\CalculateScore\Services\CalculateScoreConverter;
use App\Aplication\CalculateScore\Services\CalculateScoreSearcher;
use App\Aplication\Shared\GenerateCalculateScore;
use App\Domain\Repository\AdvertisementRepositoryInterface;
use App\Domain\Services\CalculateScore\CalculateScoreAdvertisement;
use App\Domain\Services\CalculateScore\CalculateScoreDescription;
use App\Domain\Services\CalculateScore\CalculateScorePictures;
use App\Domain\Services\CalculateScore\CalculateScoreTypology;
use App\Infrastructure\Api\CalculateScoreAd;
use App\Tests\Utils\AdvertisementFixtures;
use App\Tests\Utils\CalculateScoreFixtures;
use JetBrains\PhpStorm\NoReturn;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class CalculateScoreUseCaseTest extends TestCase
{

    private AdvertisementRepositoryInterface | MockInterface $repository;


    public function setUp(): void
    {
        $this->repository = Mockery::mock(AdvertisementRepositoryInterface::class);
    }

    /** @test */
    public function it_should_return_empty_ad(): void
    {
        $useCase = $this->createCalculateScoreUseCase();

        $response = ($useCase)();

        self::assertIsArray($response);
        self::assertCount(0, $response);

    }

    /** @test */
    #[NoReturn] public function it_should_return_ads(): void
    {
        $countAds = 5;
        $adsFixtures = AdvertisementFixtures::createAdvertisementsByNumberToCalculateScore($countAds);
        $useCase = $this->createCalculateScoreUseCase($adsFixtures);
        $propertiesValues = CalculateScoreFixtures::getAllProperties();

        $response = ($useCase)();

        self::assertIsArray($response);
        self::assertNotEmpty($response);
        self::assertCount($countAds, $response);
        foreach ($propertiesValues as $value) {
            self::assertTrue(\in_array($value,array_keys($response[0])));
        }

    }

    private function createCalculateScoreUseCase(array $ads = []): CalculateScoreUseCase
    {

        $repository = $this->shouldEmptyAds($ads);
        $calculateScoreSearcher = new CalculateScoreSearcher($repository);
        $calculateScoreConverter = new CalculateScoreConverter();
        $calculateScoreAdvertisement = $this->createCalculateScoreAdvertisement();
        $generateCalculateScore = new GenerateCalculateScore($calculateScoreAdvertisement);

        return new CalculateScoreUseCase($calculateScoreSearcher,$calculateScoreConverter,$generateCalculateScore);
    }

    private function shouldEmptyAds(array $ads)
    {
        $this->repository
            ->expects('findAllAds')
            ->once()
            ->andReturn($ads);

        return $this->repository;
    }

    private function createCalculateScoreAdvertisement(): CalculateScoreAdvertisement
    {
        $calculateScoreDescription = new CalculateScoreDescription();
        $calculateScoreTypology = new CalculateScoreTypology();
        $calculateScorePictures = new CalculateScorePictures();
        return new CalculateScoreAdvertisement($calculateScoreDescription,$calculateScoreTypology,$calculateScorePictures);
    }
}
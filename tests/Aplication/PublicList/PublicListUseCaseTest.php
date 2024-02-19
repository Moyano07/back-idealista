<?php

declare(strict_types=1);

use App\Aplication\PublicList\PublicListUseCase;
use App\Aplication\PublicList\Services\PublicListConverter;
use App\Aplication\PublicList\Services\PublicListFilter;
use App\Aplication\PublicList\Services\PublicListSearcher;
use App\Aplication\Shared\GenerateCalculateScore;
use App\Domain\Repository\AdvertisementRepositoryInterface;
use App\Domain\Services\CalculateScore\CalculateScoreAdvertisement;
use App\Domain\Services\CalculateScore\CalculateScoreDescription;
use App\Domain\Services\CalculateScore\CalculateScorePictures;
use App\Domain\Services\CalculateScore\CalculateScoreTypology;
use App\Domain\Services\PublicList\PublicListAdvertisementFilter;
use App\Tests\Utils\AdvertisementFixtures;
use App\Tests\Utils\CalculateScoreFixtures;
use App\Tests\Utils\PublicListFixtures;
use JetBrains\PhpStorm\NoReturn;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class PublicListUseCaseTest extends TestCase
{

    private AdvertisementRepositoryInterface|MockInterface $repository;


    public function setUp(): void
    {
        $this->repository = Mockery::mock(AdvertisementRepositoryInterface::class);
    }

    /** @test */
    public function it_should_return_empty_ad(): void
    {
        $useCase = $this->createPublicListUseCase();
        $response = ($useCase)();

        self::assertIsArray($response);
        self::assertCount(0, $response);

    }

    /** @test */
    #[NoReturn] public function it_should_return_ads(): void
    {
        $countAds = 6;
        $adsFixtures = AdvertisementFixtures::createAdvertisementsByNumberToCalculateScore($countAds);
        $useCase = $this->createPublicListUseCase($adsFixtures);
        $propertiesValues = PublicListFixtures::getAllProperties();

        $response = ($useCase)();
        self::assertIsArray($response);
        foreach ($response as $ad) {
            foreach ($propertiesValues as $value) {
                self::assertTrue(\in_array($value, array_keys($ad)));
            }
        }
    }

    private function createPublicListUseCase(array $ads = []): PublicListUseCase
    {
        $repository = $this->shouldAds($ads);
        $searcher = new PublicListSearcher($repository);
        $calculateScoreAdvertisement = $this->createCalculateScoreAdvertisement();
        $generateCalculateScore = new GenerateCalculateScore($calculateScoreAdvertisement);
        $publicListFilter = $this->createPublicListFilter();
        $converter = new PublicListConverter();

        return new PublicListUseCase($searcher, $generateCalculateScore, $publicListFilter, $converter);

    }

    private function shouldAds(array $ads)
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
        return new CalculateScoreAdvertisement($calculateScoreDescription, $calculateScoreTypology, $calculateScorePictures);
    }

    private function createPublicListFilter(): PublicListFilter
    {
        $publicListAdvertisementFilter = new PublicListAdvertisementFilter();

        return new PublicListFilter($publicListAdvertisementFilter);
    }
}
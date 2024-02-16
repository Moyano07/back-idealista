<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Ad;
use App\Domain\Picture;
use App\Domain\Repository\AdvertisementRepositoryInterface;

final class InFileSystemPersistence implements AdvertisementRepositoryInterface
{
    private array $ads = [];
    private array $pictures = [];

    public function __construct()
    {
        array_push($this->ads, new Ad(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null));
        array_push($this->ads, new Ad(2, 'FLAT', 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', [4], 300, null, null, null));
        array_push($this->ads, new Ad(3, 'CHALET', '', [2], 300, null, null, null));
        array_push($this->ads, new Ad(4, 'FLAT', 'Ático céntrico muy luminoso y recién reformado, parece nuevo', [5], 300, null, null, null));
        array_push($this->ads, new Ad(5, 'FLAT', 'Pisazo,', [3, 8], 300, null, null, null));
        array_push($this->ads, new Ad(6, 'GARAGE', '', [6], 300, null, null, null));
        array_push($this->ads, new Ad(7, 'GARAGE', 'Garaje en el centro de Albacete', [], 300, null, null, null));
        array_push($this->ads, new Ad(8, 'CHALET', 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', [1, 7], 300, null, null, null));

        array_push($this->pictures, new Picture(1, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'SD'));
        array_push($this->pictures, new Picture(2, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'HD'));
        array_push($this->pictures, new Picture(3, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'SD'));
        array_push($this->pictures, new Picture(4, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'HD'));
        array_push($this->pictures, new Picture(5, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'SD'));
        array_push($this->pictures, new Picture(6, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'SD'));
        array_push($this->pictures, new Picture(7, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'SD'));
        array_push($this->pictures, new Picture(8, 'https://estudibasic.es/wp-content/uploads/2016/09/estudibasic-renders-de-interiores-3d-para-venta-inmobiliaria-1.jpg', 'HD'));
    }

    public function findAllAds(): array
    {
        $ads = $this->ads;
        /** @var Ad $ad */
        foreach ($ads as $ad) {
            $ad->setPictures($this->findPictureById($ad->getPictures()));
        }

        return $ads;
    }

    public function findPictureById(array $ids): array
    {
        $p = [];
        foreach ($this->pictures as $picture) {
            if (in_array($picture->getId(), $ids)) {
                $p[] =$picture;
            }
        }

        return $p;
    }

}

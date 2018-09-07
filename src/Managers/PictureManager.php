<?php

namespace SvenH\PetFishCo\Managers;

use SvenH\PetFishCo\Entity\Picture;
use SvenH\PetFishCo\Model\PictureInterface;

/**
 * ORM manager for picture entity
 */
class PictureManager
{
    /**
     * Create a picture
     *
     * @param string $fileName
     * @param string $binary
     *
     * @return PictureInterface
     */
    public function createPicture(string $fileName, string $binary): PictureInterface
    {
        return new Picture($fileName, $binary);
    }
}
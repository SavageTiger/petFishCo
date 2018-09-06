<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Entity\Model\Picture as BasePicture;

/**
 * @ORM\Entity
 * @ORM\Table(name="picture")
 */
class Picture extends BasePicture
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     */
    protected $filename;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     */
    protected $binary;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->filename;
    }
}

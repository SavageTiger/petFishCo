<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Aquarium as BaseAquarium;

/**
 * @ORM\Entity
 * @ORM\Table(name="aquarium")
 */
class Aquarium extends BaseAquarium
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyValue")
     */
    protected $shape;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyValue")
     */
    protected $glassType;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    protected $volume;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->description;
    }
}

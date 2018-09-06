<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Entity\Model\Aquarium as BaseAquarium;

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
     * @ORM\ManyToOne(targetEntity="Shape")
     */
    protected $shape;

    /**
     * @ORM\ManyToOne(targetEntity="Glass")
     */
    protected $glassType;

    /**
     * @ORM\Column(type="double", nullable=false)
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

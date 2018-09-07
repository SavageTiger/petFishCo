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
     * @ORM\GeneratedValue("UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     */
    protected $shape;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     */
    protected $glassType;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    protected $volume;

    /**
     * @ORM\OneToMany(targetEntity="AquariumMutation", mappedBy="aquarium")
     */
    protected $mutations;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->description;
    }
}

<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Entity\Model\Family as BaseFamily;

/**
 * @ORM\Entity
 * @ORM\Table(name="fish_family")
 */
class Family extends BaseFamily
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $name;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->name;
    }
}

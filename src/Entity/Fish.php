<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Fish as BaseFish;

/**
 * @ORM\Entity
 * @ORM\Table(name="fish")
 */
class Fish extends BaseFish
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     */
    protected $latinName;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyValue")
     * @ORM\JoinColumn(name="family_id", referencedColumnName="id")
     */
    protected $family;

    /**
     * @ORM\Column(type="string", nullable=false, length=8)
     */
    protected $color;

    /**
     * @ORM\Column(type="smallint", nullable=false, length=32)
     */
    protected $fins;

    /**
     * @ORM\OneToOne(targetEntity="Picture")
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id")
     */
    protected $picture;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->name;
    }
}

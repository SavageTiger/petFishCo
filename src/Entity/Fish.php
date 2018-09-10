<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Fish as BaseFish;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="fish")
 */
class Fish extends BaseFish
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue("UUID")
     *
     * @Serializer\Groups({"list", "detail"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     *
     * @Serializer\Groups({"list", "detail"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     *
     * @Serializer\Groups({"detail"})
     */
    protected $latinName;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     * @ORM\JoinColumn(name="family_id", referencedColumnName="id", nullable=false)
     *
     * @Serializer\Type("property<Fish_Family>")
     * @Serializer\Groups({"list", "detail"})
     */
    protected $family;

    /**
     * @ORM\Column(type="string", nullable=false, length=8)
     *
     * @Serializer\Groups({"list", "detail"})
     */
    protected $color;

    /**
     * @ORM\Column(type="smallint", nullable=false, length=32)
     *
     * @Serializer\Groups({"detail"})
     */
    protected $fins;

    /**
     * @ORM\OneToOne(targetEntity="Picture", cascade={"PERSIST", "REMOVE"})
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", nullable=true)
     *
     * @Serializer\Groups({"detail"})
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

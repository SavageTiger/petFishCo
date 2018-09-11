<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Fish as BaseFish;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Serializer\Groups({"list", "detail", "inventory"})
     */
    protected $id;

    /**
     * @Assert\NotBlank(message="Please provide a name");
     *
     * @ORM\Column(type="string", nullable=false, length=64)
     *
     * @Serializer\Groups({"list", "detail", "inventory"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=true, length=64)
     *
     * @Serializer\Groups({"detail"})
     */
    protected $latinName;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     * @ORM\JoinColumn(name="family_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotBlank(message="Family is required");
     *
     * @Serializer\Type("property<Fish_Family>")
     * @Serializer\Groups({"list", "detail"})
     */
    protected $family;

    /**
     * @ORM\Column(type="string", nullable=false, length=8)
     *
     * @Assert\NotBlank(message="Please provide a valid color (e.g. FFFFFF)");
     * @Assert\Regex(pattern="/[a-zA-Z0-9]{6}/", message="Please provide a valid color (e.g. FFFFFF)");
     *
     * @Serializer\Groups({"list", "detail"})
     */
    protected $color;

    /**
     * @ORM\Column(type="smallint", nullable=false, length=32)
     *
     * @Assert\NotBlank(message="Please provide the amount of fins");
     * @Assert\Expression("this.getFins() > 0", message="A fish needs at-least one fin")
     *
     * @Serializer\Groups({"detail"})
     */
    protected $fins;

    /**
     * @ORM\OneToOne(targetEntity="Picture", cascade={"PERSIST", "REMOVE"}, orphanRemoval=true)
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

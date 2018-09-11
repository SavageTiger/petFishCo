<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Aquarium as BaseAquarium;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;


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
     *
     * @Serializer\Groups({"list", "detail", "inventory"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     *
     * @Assert\NotBlank(message="Please provide a brief description");
     *
     * @Serializer\Groups({"list", "detail", "inventory"})
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     *
     * @Assert\NotBlank(message="Please set a Shape");
     *
     * @Serializer\Type("property<Shape>")
     * @Serializer\Groups({"detail", "inventory"})
     */
    protected $shape;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     *
     * @Assert\NotBlank(message="Please select a glass type");
     *
     * @Serializer\Type("property<Glass>")
     * @Serializer\Groups({"detail", "inventory"})
     */
    protected $glassType;

    /**
     * @ORM\Column(type="float", nullable=false)
     *
     * @Assert\NotBlank(message="Please provide the volume of the aquarium");
     * @Assert\GreaterThan(value="0", message="Aquarium to small")
     *
     * @Serializer\Groups({"detail", "inventory"})
     */
    protected $volume;

    /**
     * @ORM\Column(type="string", nullable=false, length=8)
     *
     * @Assert\Regex(pattern="/liters|gallons/", message="Unsupported volume unit (supported is liters and gallons)");
     *
     * @Serializer\Groups({"detail", "inventory"})
     */
    protected $volumeUnit = 'liters';

    /**
     * @ORM\OneToMany(targetEntity="AquariumMutation", mappedBy="aquarium")
     * @ORM\OrderBy({"timestamp" = "ASC"})
     *
     * @Serializer\Groups({"mutations"})
     */
    protected $mutations;

    /**
     * @Serializer\Groups({"inventory"})
     * @Serializer\Accessor(getter="getInventory")
     */
    protected $inventory;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->description;
    }
}

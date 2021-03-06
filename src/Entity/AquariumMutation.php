<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\AquariumMutation as BaseAquariumMutation;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="aquarium_fish_mutation")
 *
 * @SvenH\PetFishCo\Constraints\InventoryRestriction
 */
class AquariumMutation extends BaseAquariumMutation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Fish")
     * @ORM\JoinColumn(name="fish_id", referencedColumnName="id", nullable=false)
     *
     * @Serializer\Groups({"mutations"})
     */
    protected $fish;

    /**
     * @ORM\ManyToOne(targetEntity="Aquarium", inversedBy="mutations", cascade={"PERSIST", "REMOVE"})
     * @ORM\JoinColumn(name="aquarium_id", referencedColumnName="id")
     */
    protected $aquarium;

    /**
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"mutations"})
     */
    protected $amount = 0;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Serializer\Groups({"mutations"})
     */
    protected $timestamp;
}

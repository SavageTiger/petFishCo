<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\AquariumMutation as BaseAquariumMutation;

/**
 * @ORM\Entity
 * @ORM\Table(name="aquarium_fish_mutation")
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
     */
    protected $fish;

    /**
     * @ORM\ManyToOne(targetEntity="Aquarium", inversedBy="mutations", cascade={"PERSIST", "REMOVE"})
     * @ORM\JoinColumn(name="aquarium_id", referencedColumnName="id")
     */
    protected $aquarium;

    /**
     * @ORM\Column(type="integer")
     */
    protected $amount = 0;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $timestamp;
}

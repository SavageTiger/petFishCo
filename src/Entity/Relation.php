<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Relation as BaseRelation;

/**
 * @ORM\Entity
 * @ORM\Table(name="aquarium_fish_relatio")
 */
class Relation extends BaseRelation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Fish")
     */
    protected $fish;

    /**
     * @ORM\ManyToOne(targetEntity="Aquarium")
     * @ORM\JoinColumn(name="aquarium_id", referencedColumnName="id", nullable=true)
     */
    protected $aquarium;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $timestamp;
}

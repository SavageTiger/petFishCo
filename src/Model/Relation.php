<?php

namespace SvenH\PetFishCo\Model;

/**
 * Event of a fish being placed in a aquarium
 */
class Relation implements RelationInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var FishInterface
     */
    protected $fish;

    /**
     * @var AquariumInterface|null
     */
    protected $aquarium;

    /**
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @param FishInterface          $fish
     * @param AquariumInterface|null $aquarium
     */
    public function __construct(FishInterface $fish, AquariumInterface $aquarium = null)
    {
        $this->fish      = $fish;
        $this->aquarium  = $aquarium;
        $this->timestamp = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getFish(): FishInterface
    {
        return $this->fish;
    }

    /**
     * {@inheritdoc}
     */
    public function getAquarium(): ?AquariumInterface
    {
        return $this->aquarium;
    }

    /**
     * {@inheritdoc}
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }
}

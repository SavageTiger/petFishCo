<?php

namespace SvenH\PetFishCo\Model;

/**
 * When multiple fish are added or removed from a aquarium
 * we add a mutation so we can always reconstruct the state of the tank
 * in a certain moment in time
 */
class AquariumMutation implements AquariumMutationInterface
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
     * @var int
     */
    protected $amount;

    /**
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @param FishInterface     $fish
     * @param AquariumInterface $aquarium
     * @param int               $amount
     */
    public function __construct(FishInterface $fish, AquariumInterface $aquarium, int $amount = 0)
    {
        $this->fish      = $fish;
        $this->aquarium  = $aquarium;
        $this->amount    = $amount;
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
    public function getAquarium(): AquariumInterface
    {
        return $this->aquarium;
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount(): int
    {
       return $this->amount;
    }

    /**
     * {@inheritdoc}
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }
}

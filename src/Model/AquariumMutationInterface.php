<?php

namespace SvenH\PetFishCo\Model;

/**
 * The last known location of a fish
 */
interface AquariumMutationInterface
{
    /**
     * Get the fish subject
     *
     * @return FishInterface
     */
    public function getFish(): FishInterface;

    /**
     * Get the aquarium subject
     *
     * @return AquariumInterface
     */
    public function getAquarium(): AquariumInterface;

    /**
     * How many fish have been added or removed
     *
     * @return int
     */
    public function getAmount(): int;

    /**
     * When was this mutation
     *
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime;
}

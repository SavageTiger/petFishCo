<?php

namespace SvenH\PetFishCo\Model;

/**
 * The last known location of a fish
 */
interface RelationInterface
{
    /**
     * Get the subject (fish)
     *
     * @return FishInterface
     */
    public function getFish(): FishInterface;

    /**
     * Get the aquarium
     * If the aquarium is null the fish has been sold
     *
     * @return AquariumInterface|null
     */
    public function getAquarium(): ?AquariumInterface;

    /**
     * When was this fish moved or placed?
     *
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime;
}

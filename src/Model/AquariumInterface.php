<?php

namespace SvenH\PetFishCo\Model;

/**
 * Aquarium
 */
interface AquariumInterface
{
    /**
     * Set the id
     *
     * @param string $id
     */
    public function setId(string $id);

    /**
     * Get the id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Set the shape
     *
     * @param PropertyInterface $shape
     */
    public function setShape(PropertyInterface $shape);

    /**
     * Get the shape
     *
     * @return PropertyInterface
     */
    public function getShape(): PropertyInterface;

    /**
     * Set the glass type
     *
     * @param PropertyInterface $glassType
     */
    public function setGlassType(PropertyInterface $glassType);

    /**
     * Get glass type
     *
     * @return PropertyInterface
     */
    public function getGlassType(): PropertyInterface;

    /**
     * Set the volume of the aquarium in liters
     *
     * @param float $volume
     */
    public function setVolume(float $volume);

     /**
      * Get the volume of the aquarium in liters
      *
      * @return float
      */
     public function getVolume(): float;

     /**
      * Get the amount of fish in this aquarium in the following format [ FishInterface => <count>, ... ]
      *
      * @return array
      */
     public function getFish();
}

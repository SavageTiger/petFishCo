<?php

namespace SvenH\PetFishCo\Model;

/**
 * Aquarium
 */
interface AquariumInterface
{
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
     * Set the volume of the aquarium in the unit specified in the volumeUnit property
     *
     * @param float $volume
     */
    public function setVolume(float $volume);

    /**
     * Define the unit of the volume
     *
     * @param string $unit
     */
    public function setVolumeUnit(string $unit = 'liters');

     /**
      * Get the volume of the aquarium in liters
      *
      * @param string $unit Get the volume in gallons or liters
      *
      * @return float
      */
     public function getVolume(string $unit): float;

     /**
      * Get the amount of fish in this aquarium in the following format [ 'fish' => Fish, 'amount' => 123 ]
      *
      * @return array
      */
     public function getInventory(): array;
}

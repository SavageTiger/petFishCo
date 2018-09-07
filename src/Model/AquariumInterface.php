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
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Get description
     *
     * @return string
     */
    public function getName(): string;

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
}

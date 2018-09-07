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
     * @param PropertyValueInterface $shape
     */
    public function setShape(PropertyValueInterface $shape);

    /**
     * Get the shape
     *
     * @return PropertyValueInterface
     */
    public function getShape(): PropertyValueInterface;

    /**
     * Set the glass type
     *
     * @param PropertyValueInterface $glassType
     */
    public function setGlassType(PropertyValueInterface $glassType);

    /**
     * Get glass type
     *
     * @return PropertyValueInterface
     */
    public function getGlassType(): PropertyValueInterface;

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

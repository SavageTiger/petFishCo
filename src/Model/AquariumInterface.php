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
     * Set the shape of this aquarium
     *
     * @param ShapeInterface $shape
     */
    public function setShape(ShapeInterface $shape);

    /**
     * Get the shape of this aquarium
     *
     * @return ShapeInterface
     */
    public function getShape(): ShapeInterface;

    /**
     * Set glass type
     *
     * @param GlassInterface $name
     */
    public function setName(GlassInterface $name);

    /**
     * Get glass type
     *
     * @return GlassInterface
     */
    public function getName(): GlassInterface;

    /**
     * The amount of water in liters
     *
     * @param double $name
     */
    public function setName(double $name);

    /**
     * Get the amount of water in liters
     *
     * @return double
     */
    public function getName(): double;
}

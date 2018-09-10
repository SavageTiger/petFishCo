<?php

namespace SvenH\PetFishCo\Model;

/**
 * Fish
 */
interface FishInterface
{
    /**
     * Get the id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Set the popularly name
     *
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Get the popularly name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set latin name
     *
     * @param string $name
     */
    public function setLatinName(string $name);

    /**
     * Get latin name
     *
     * @return string
     */
    public function getLatinName(): string;

    /**
     * Set fish family
     *
     * @param PropertyInterface $family
     */
    public function setFamily(PropertyInterface $family);

    /**
     * Get fish family
     *
     * @return PropertyInterface
     */
    public function getFamily(): PropertyInterface;

    /**
     * Get fish family name from the property object
     *
     * @return string
     */
    public function getFamilyName(): string;

    /**
     * Set the primary color of the fish in hexadecimal notation
     *
     * @param string $color
     */
    public function setColor(string $color);

    /**
     * Get the primary color of the fish in hexadecimal notation
     *
     * @return string
     */
    public function getColor(): string;

    /**
     * Set the amount of fins
     *
     * @param integer $amount
     */
    public function setFins(int $amount);

    /**
     * Get the amount of fins
     *
     * @return integer|null
     */
    public function getFins(): ?int;

    /**
     * Set a picture of this fish
     *
     * @param PictureInterface $picture
     */
    public function setPicture(PictureInterface $picture);

    /**
     * Get a picture of this fish
     *
     * @return PictureInterface|null
     */
    public function getPicture(): ?PictureInterface;
}

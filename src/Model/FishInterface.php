<?php

namespace SvenH\PetFishCo\Model;

/**
 * Fish
 */
interface FishInterface
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
     * @param PropertyValueInterface $family
     */
    public function setFamily(PropertyValueInterface $family);

    /**
     * Get fish family
     *
     * @return PropertyValueInterface
     */
    public function getFamily(): PropertyValueInterface;

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
    public function setAmount(int $amount);

    /**
     * Get the amount of fins
     *
     * @return integer
     */
    public function getAmount(): int;

    /**
     * Set a picture of this fish
     *
     * @param PictureInterface $picture
     */
    public function setPicture(PictureInterface $picture);

    /**
     * Get a picture of this fish
     *
     * @return PictureInterface
     */
    public function getPicture(): PictureInterface;
}

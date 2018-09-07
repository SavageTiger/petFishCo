<?php

namespace SvenH\PetFishCo\Model;

/**
 * Picture
 */
interface PictureInterface
{
    /**
     * Get the id
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Get origin filename
     *
     * @return string
     */
    public function getFilename(): string;

    /**
     * Set binary data
     *
     * @param string $name
     */
    public function getBinary();
}

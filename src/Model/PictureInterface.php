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
     * Get binary
     *
     * @param bool $asBase64
     *
     * @return mixed
     */
    public function getBinary(bool $asBase64 = true);
}

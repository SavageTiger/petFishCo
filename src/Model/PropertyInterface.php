<?php

namespace SvenH\PetFishCo\Model;

interface PropertyInterface
{
    /**
     * Get the id of this property value object
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Get the value
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Set the value
     *
     * @param string $value
     */
    public function setValue(string $value);
}

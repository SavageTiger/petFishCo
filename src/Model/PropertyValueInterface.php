<?php

namespace SvenH\PetFishCo\Model;

interface PropertyValueInterface
{
    /**
     * Get the value
     *
     * @return string
     */
    public function getValue(): string;
}

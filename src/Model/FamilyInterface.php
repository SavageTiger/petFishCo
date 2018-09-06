<?php

namespace SvenH\PetFishCo\Model;

/**
 * Fish Family
 */
interface FamilyInterface
{
    /**
     * Get the id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;
}

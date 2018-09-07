<?php

namespace SvenH\PetFishCo\Model;

/**
 * Aquarium
 */
class Aquarium implements AquariumInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var PropertyInterface
     */
    protected $shape;

    /**
     * @var PropertyInterface
     */
    protected $glassType;

    /**
     * @var double
     */
    protected $volume;

    /**
     * {@inheritdoc}
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setShape(PropertyInterface $shape)
    {
        $this->shape = $shape;
    }

    /**
     * {@inheritdoc}
     */
    public function getShape(): PropertyInterface
    {
        return $this->shape;
    }

    /**
     * {@inheritdoc}
     */
    public function setGlassType(PropertyInterface $glassType)
    {
        $this->glassType = $glassType;
    }

    /**
     * {@inheritdoc}
     */
    public function getGlassType(): PropertyInterface
    {
        return $this->glassType;
    }

    /**
     * {@inheritdoc}
     */
    public function setVolume(float $volume)
    {
        $this->volume = $volume;
    }

    /**
     * {@inheritdoc}
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * {@inheritdoc}
     */
    public function getFish(): float
    {
        // TODO
    }
}

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
     * @var PropertyValueInterface
     */
    protected $shape;

    /**
     * @var PropertyValueInterface
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
    public function setName(string $name)
    {
        $this->description = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setShape(PropertyValueInterface $shape)
    {
        $this->shape = $shape;
    }

    /**
     * {@inheritdoc}
     */
    public function getShape(): PropertyValueInterface
    {
        return $this->shape;
    }

    /**
     * {@inheritdoc}
     */
    public function setGlassType(PropertyValueInterface $glassType)
    {
        $this->glassType = $glassType;
    }

    /**
     * {@inheritdoc}
     */
    public function getGlassType(): PropertyValueInterface
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
}

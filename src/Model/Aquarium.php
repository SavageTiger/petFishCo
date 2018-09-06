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
     * @var ShapeInterface
     */
    protected $shape;

    /**
     * @var GlassInterface
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
    public function setShape(ShapeInterface $shape)
    {
        $this->shape = $shape;
    }

    /**
     * {@inheritdoc}
     */
    public function getShape(): ShapeInterface
    {
        return $this->shape;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(GlassInterface $name)
    {
        $this->glassType = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): GlassInterface
    {
        return $this->glassType;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(double $name)
    {
        $this->volume = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): double
    {
        return $this->volume;
    }
}

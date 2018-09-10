<?php

namespace SvenH\PetFishCo\Model;

/**
 * Fish
 */
class Fish implements FishInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $latinName;

    /**
     * @var PropertyInterface
     */
    protected $family;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var integer
     */
    protected $fins;

    /**
     * @var PictureInterface
     */
    protected $picture;

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
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setLatinName(string $name)
    {
        $this->latinName = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatinName(): string
    {
        return $this->latinName;
    }

    /**
     * {@inheritdoc}
     */
    public function setFamily(PropertyInterface $family)
    {
        $this->family = $family;
    }

    /**
     * {@inheritdoc}
     */
    public function getFamily(): PropertyInterface
    {
        return $this->family;
    }

    /**
     * {@inheritdoc}
     */
    public function getFamilyName(): string
    {
        return $this->family->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function setColor(string $color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritdoc}
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * {@inheritdoc}
     */
    public function setFins(int $amount)
    {
        $this->fins = $amount;
    }

    /**
     * {@inheritdoc}
     */
    public function getFins(): int
    {
        return $this->fins;
    }

    /**
     * {@inheritdoc}
     */
    public function setPicture(PictureInterface $picture)
    {
        $this->picture = $picture;
    }

    /**
     * {@inheritdoc}
     */
    public function getPicture(): PictureInterface
    {
        return $this->picture;
    }
}

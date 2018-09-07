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
     * @var PropertyValueInterface
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
    public function setFamily(PropertyValueInterface $family)
    {
        $this->family = $family;
    }

    /**
     * {@inheritdoc}
     */
    public function getFamily(): PropertyValueInterface
    {
        return $this->family;
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
    public function setAmount(int $amount)
    {
        $this->fins = $amount;
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount(): int
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

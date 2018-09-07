<?php

namespace SvenH\PetFishCo\Model;

use Symfony\Component\Serializer\Annotation\Groups;

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
     *
     * @Groups({"list", "detail"})
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
     *
     * @Groups({"list", "detail"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     *
     * @Groups({"detail"})
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
     *
     * @Groups({"list", "detail"})
     */
    public function getFamily(): PropertyInterface
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
     *
     * @Groups({"list", "detail"})
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
     *
     * @Groups({"detail"})
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
     *
     * @Groups({"detail"})
     */
    public function getPicture(): PictureInterface
    {
        return $this->picture;
    }
}

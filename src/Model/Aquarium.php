<?php

namespace SvenH\PetFishCo\Model;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

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
     * @var string
     */
    protected $volumeUnit;

    /**
     * @var AquariumMutation[]
     */
    protected $mutations;

    /**
     * Aquarium constructor
     */
    public function __construct()
    {
        $this->mutations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     *
     * @Serializer\Groups({"list"})
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
     *
     * @Serializer\Groups({"list"})
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
    public function setVolumeUnit(string $unit = 'liters')
    {
        if ($unit !== 'liters' || $unit !== 'gallons') {
            throw new \Exception('Invalid unit supplied, accepted units are "liters" and "gallons"');
        }

        $this->volumeUnit = $unit;
    }


    /**
     * {@inheritdoc}
     */
    public function getVolume(string $unit = 'liters'): float
    {
        if ($unit !== 'liters' && $unit !== 'gallons') {
            throw new \Exception('Invalid unit requested, supported units are "liters" and "gallons"');
        }

        if ($this->volumeUnit === 'liters' && $unit === 'gallons') {
            return ($this->volume / 3.7854);
        } else if ($this->volumeUnit === 'gallons' && $unit === 'liters') {
            return ($this->volume * 3.7854);
        }

        return $this->volume;
    }

    /**
     * Get fishes in this aquarium
     *
     * @return array<FishesInterface>
     */
    public function getFishes(): array
    {
        $buffer   = [];
        $inventory = $this->getInventory();

        foreach ($inventory as $inventoryItem) {
            if ($inventoryItem['amount'] > 0) {
                $buffer[] = $inventoryItem['fish'];
            }
        }

        return $buffer;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventory(): array
    {
        $buffer = [];
        $amount = [];
        $fishes = [];

        $mutations = $this->mutations;

        foreach ($mutations as $mutation) {
            if (isset($amount[$mutation->getFish()->getId()]) === false) {
                $amount[$mutation->getFish()->getId()] = 0;
                $fishes[$mutation->getFish()->getId()] = $mutation->getFish();
            }

            $amount[$mutation->getFish()->getId()] += $mutation->getAmount();
        }

        foreach($fishes as $fishId => $fish)
        {
            if ((int) $amount[$fishId] !== 0) {
                $buffer[] = [
                    'fish' => $fish,
                    'amount' => $amount[$fishId]
                ];
            }
        }

        return $buffer;
    }
}

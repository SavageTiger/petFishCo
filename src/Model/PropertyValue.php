<?php

namespace SvenH\PetFishCo\Model;

class PropertyValue implements PropertyValueInterface
{
    protected const TYPES = [0 => 'glass', 1 => 'shape', 2 => 'family'];

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $type;

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }
}

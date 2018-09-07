<?php

namespace SvenH\PetFishCo\Model;

class PropertyValue implements PropertyValueInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var PropertyInterface
     */
    protected $property;

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }
}

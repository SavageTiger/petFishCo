<?php

namespace SvenH\PetFishCo\Serializer;

use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use SvenH\PetFishCo\Managers\PropertyManager;
use SvenH\PetFishCo\Model\PropertyInterface;

class PropertyTypeHandler
{
    /**
     * @var PropertyManager
     */
    protected $propertyManager;

    /**
     * Customer serializer handler for the PropertyType entity
     *
     * @param PropertyManager $propertyManager
     */
    public function __construct(PropertyManager $propertyManager)
    {
        $this->propertyManager = $propertyManager;
    }

    /**
     * @param JsonSerializationVisitor $visitor
     * @param PropertyInterface        $valur
     * @param array                    $type
     *
     * @return string
     */
    public function serializePropertyToJson(JsonSerializationVisitor $visitor, PropertyInterface $value, array $type): string
    {
        return $value->getValue();
    }

    /**
     * @param JsonSerializationVisitor $visitor
     * @param string                   $value
     * @param array                    $type
     *
     * @return null|PropertyInterface
     */
    public function deserializePropertyFromJson(JsonDeserializationVisitor $visitor, string $value, array $type)
    {
        $propertyType = current($type['params']);

        if (is_array($propertyType)) {
            $propertyType = current($propertyType);
            $propertyType = str_replace('_', ' ', $propertyType);
        } else {
            return null;
        }

        return $this->propertyManager->findProperty($value, $propertyType);
    }
}

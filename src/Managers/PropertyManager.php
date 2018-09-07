<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\ORM\EntityManagerInterface;
use SvenH\PetFishCo\Entity\Property;

class PropertyManager
{
    /**
     * Property name to internal id mapping
     */
    protected const PROPERTY_TYPES = [
        0 => 'Glass',
        1 => 'Shape',
        2 => 'Fish Family'
    ];

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * PropertyManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Create a new property
     *
     * @param string $value
     * @param string $typeName
     *
     * @throws \Exception
     */
    public function createProperty(string $value, string $typeName)
    {
        $type = $this->getTypeIdByName($typeName);

        if ($type === null) {
            throw new \Exception('Requested type identifier was not found.');
        }

        $property = new Property($value, $type);

        $this->em->persist($property);
        $this->em->flush();
    }

    /**
     * Get a table of available identifier codes for
     * property types
     *
     * eg ['1337' => 'Pizza toppings']
     *
     * @return array
     */
    public function getAvailableTypes()
    {
        return self::PROPERTY_TYPES;
    }

    /**
     * Resolve a  property type identifier by name
     *
     * @param string $name
     *
     * @return int|null
     */
    public function getTypeIdByName(string $name)
    {
        $types = $this->getAvailableTypes();

        foreach ($types as $id => $propertyName) {
            if ($name === $propertyName) {
                return $id;
            }
        }

        return null;
    }

    /**
     * Is their a property present with the given value and type
     *
     * @param string $value
     * @param string $typeName
     *
     * @return bool
     */
    public function propertyExists(string $value, string $typeName)
    {
        return (bool) ($this->em->getRepository(Property::class)->findOneBy([
            'value' => $value,
            'type'  => $this->getTypeIdByName($typeName)
        ]) !== null);
    }
}
<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\ORM\EntityManagerInterface;
use SvenH\PetFishCo\Entity\Property;
use SvenH\PetFishCo\Model\PropertyInterface;

/**
 * Manager for property entity
 */
class PropertyManager
{
    /**
     * Property name to internal id mapping
     */
    protected const PROPERTY_TYPES = [
        0 => 'Glass',
        1 => 'Shape',
        2 => 'Fish Family',
        3 => 'Restriction'
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
     * @param bool   $persist
     *
     * @throws \Exception
     *
     * @return PropertyInterface
     */
    public function createProperty(string $value, string $typeName, bool $persist = false): PropertyInterface
    {
        $type = $this->getTypeIdByName($typeName);

        if ($type === null) {
            throw new \Exception('Requested type identifier was not found.');
        }

        $property = new Property($value, $type);

        if ($persist === true) {
            $this->em->persist($property);
            $this->em->flush();
        }

        return $property;
    }


    /**
     * Get a table of available identifier codes for
     * property types
     *
     * e.g. [1337 => 'Pizza toppings']
     *
     * @return array
     */
    public function getAvailableTypes(): array
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
    public function getTypeIdByName(string $name): ?int
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
     * Find a property object by type and value criteria
     *
     * @param string $value
     * @param string $typeName
     *
     * @return PropertyInterface|null
     */
    public function findProperty(string $value, string $typeName): ?PropertyInterface
    {
        return $this->em->getRepository(Property::class)->findOneBy([
            'value' => $value,
            'type'  => $this->getTypeIdByName($typeName)
        ]);
    }
}
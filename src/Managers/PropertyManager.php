<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use SvenH\PetFishCo\Entity\Property;
use SvenH\PetFishCo\Model\PropertyInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * PropertyManager constructor.
     *
     * @param EntityManagerInterface $em
     * @param ValidatorInterface     $validator
     */
    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->em        = $em;
        $this->validator = $validator;
    }

    /**
     * Create a new property
     *
     * @param string $value
     * @param mixed  $type     If a string if provided the identifier code will be resolved
     * @param bool   $persist
     *
     * @throws \Exception
     *
     * @return PropertyInterface
     */
    public function createProperty(string $value, $type, bool $persist = false): PropertyInterface
    {
        if (is_string($type)) {
            $type = $this->getTypeIdByName($type);
        }

        if ($type === null) {
            throw new \Exception('Requested type identifier was not found.');
        }

        $property = new Property($value, $type);

        $this->validate($property);

        if ($persist === true) {
            $this->em->persist($property);
            $this->em->flush();
        }

        return $property;
    }

    /**
     * Remove property
     *
     * @param PropertyInterface $property
     *
     * @throws \Exception
     */
    public function removeProperty(PropertyInterface $property)
    {
        try {
            $this->em->remove($property);
            $this->em->flush();
        } catch (DBALException $e) {
            throw new \Exception('Unable to remove this property. It has parent dependencies.');
        }
    }

    /**
     * Change the display name of existing property
     *
     * @param PropertyInterface $property
     * @param string            $displayName
     *
     * @throws \Exception
     * @return PropertyInterface
     */
    public function updatePropertyDisplayName(PropertyInterface $property, string $displayName): PropertyInterface
    {
        $property->setValue($displayName);

        $this->validate($property);

        $this->em->persist($property);
        $this->em->flush();

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
     * Get a list of properties existing for a certain type
     *
     * @param int $typeId
     *
     * @return PropertyInterface[]
     */
    public function getAllProperties(int $typeId): array
    {
        return $this->em->getRepository(Property::class)->findBy([ 'type' =>  $typeId ]);
    }

    /**
     * Get property by id
     *
     * @param int $id
     *
     * @return null|PropertyInterface
     */
    public function getPropertyById(int $id): ?PropertyInterface
    {
        return $this->em->getRepository(Property::class)->findOneBy(['id' => $id]);
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

    /**
     * Is this entity valid
     *
     * @param PropertyInterface $property
     *
     * @throws \Exception
     */
    protected function validate(PropertyInterface $property)
    {
        $invalid = $this->validator->validate($property);

        if (count($invalid) > 0) {
            /** @var ConstraintViolation $violation */
            $violation = current($invalid);
            $violation = $violation[0];

            throw new \Exception($violation->getMessage());
        }
    }
}
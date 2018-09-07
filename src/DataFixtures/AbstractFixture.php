<?php

namespace SvenH\PetFishCo\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Psr\Container\ContainerInterface;
use SvenH\PetFishCo\Model\PropertyInterface;

abstract class AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Create or find property.
     *
     * @param string $value
     * @param string $propertyType
     *
     * @return PropertyInterface
     * @throws \Exception
     */
    protected function createProperty(string $value, string $propertyType): PropertyInterface
    {
        $propertyManager = $this->container->get('petfishco.manager.property');

        $property = $propertyManager->findProperty($value, $propertyType);

        if ($property) {
            return $property;
        }

        return $propertyManager->createProperty($value, $propertyType, true);
    }
}
<?php

namespace SvenH\PetFishCo\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;

class FishFixtures implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $propertyManager = $this->container->get('petfishco.manager.property');

        $fishFixtures = [
            [
                'name'      => 'Goudvis',
                'latinName' => 'Carassius gibelio auratus',
                'family'    => 'Cyprinidae',
                'color'     => 'FF6C00',
                'fins'      => 5
            ], [
                'name'      => 'Guppy (Rood)',
                'latinName' => 'Poecilia reticulata',
                'family'    => 'Poeciliidae',
                'color'     => 'C62626',
                'fins'      => 3
            ], [
                'name'      => 'Guppy (Goud)',
                'latinName' => 'Poecilia reticulata',
                'family'    => 'Poeciliidae',
                'color'     => 'FF6C00',
                'fins'      => 3
            ], [
                'name'      => 'Driebandanemoonvis',
                'latinName' => 'Amphiprion ocellaris',
                'family'    => 'Pomacentridae',
                'color'     => 'FF6C00',
                'fins'      => 7
            ], [
                'name'      => 'Blauwe rifbaars',
                'latinName' => 'Amphiprion ocellaris',
                'family'    => 'Pomacentridae',
                'color'     => '3096FF',
                'fins'      => 3
            ]
        ];

        foreach ($fishFixtures as $fish) {
            if ($propertyManager->propertyExists($fish['family'], 'Fish Family') === false) {
                $propertyManager->createProperty($fish['family'], 'Fish Family');
            }
        }

    }

    public function getOrder()
    {
        return 0;
    }
}
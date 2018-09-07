<?php

namespace SvenH\PetFishCo\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;

class AquariumFixtures extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {
        $aquariumManager = $this->container->get('petfishco.manager.aquarium');

        $aquariumFixtures = [
            [
                'description' => 'In de wand achterin de winkel',
                'shape'       => 'Inbouw (muur)',
                'glass'       => 'Optiwhite Clear 12mm',
                'liters'      => 500,
            ], [
                'description' => 'In de wand rechterzijde van de winkel',
                'shape'       => 'Inbouw (muur)',
                'glass'       => 'Optiwhite Clear 12mm',
                'liters'      => 500,
            ], [
                'description' => 'Op de toonbank',
                'shape'       => 'Vierkant',
                'glass'       => 'Optiplex 2mm',
                'liters'      => 35
            ]
        ];

        foreach ($aquariumFixtures as $aquarium) {
            $this->createProperty($aquarium['shape'], 'Shape');
            $this->createProperty($aquarium['glass'], 'Glass');

            $aquarium = $aquariumManager->createAquarium(
                $aquarium['description'],
                $aquarium['shape'],
                $aquarium['glass'],
                $aquarium['liters']
            );

            $manager->persist($aquarium);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}
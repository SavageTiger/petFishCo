<?php

namespace SvenH\PetFishCo\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;

class RestrictionsFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $restrictions    = [] ;

        $restrictions[] =
            '{ ' .
                'expression: "aquarium.getVolume(\'liters\') <= 75 && fish.getFins() >= 3",' .
                'message: "Unable to add a fish with more ore equal to 3 fins to a tank containing less then 75 liters of water"' .
            ' }';

        $restrictions[] =
            '{ ' .
                'expression: "fish.getName() matches \"/Guppy.*/i\" && evaluateCollection(aquarium.getFishes(), \'item.getName() matches \"/Goudvis/i\"\')",' .
                'message: "Goldfish don\'t go with guppies"' .
            ' }';

        $restrictions[] =
            '{ ' .
                'expression: "fish.getName() matches \"/Goudvis/i\" && evaluateCollection(aquarium.getFishes(), \'item.getName() matches \"/Guppy.*/i\"\')",' .
                'message: "Goldfish don\'t go with guppies"' .
            ' }';

        foreach ($restrictions as $restriction) {
            $this->createProperty($restriction, 'Restriction');
        }
    }

    public function getOrder()
    {
        return 0;
    }

}
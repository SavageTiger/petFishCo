<?php

namespace SvenH\PetFishCo\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;

class MutationFixtures extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {
        $aquariumManager = $this->container->get('petfishco.manager.aquarium');
        $fishManager     = $this->container->get('petfishco.manager.fish');

        $mutations = [
            'In de wand achterin de winkel' => [
                [ 'Goudvis'            => 10 ],
                [ 'Goudvis'            => 24 ],
                [ 'Goudvis'            => -8 ],
                [ 'Driebandanemoonvis' => 20 ],
                [ 'Driebandanemoonvis' => 11 ],
                [ 'Driebandanemoonvis' => -17 ]
            ],

            'In de wand rechterzijde van de winkel' => [
                [ 'Blauwe rifbaars'    => 12 ],
                [ 'Blauwe rifbaars'    => 88 ],
                [ 'Blauwe rifbaars'    => -59 ],
                [ 'Driebandanemoonvis' => 10 ],
                [ 'Driebandanemoonvis' => 5 ],
                [ 'Driebandanemoonvis' => -8 ]
            ],

            'Op de toonbank' => [
                [ 'Guppy (Rood)' => 10 ],
                [ 'Guppy (Rood)' => 93 ],
                [ 'Guppy (Goud)' => 22 ],
                [ 'Guppy (Rood)' => -3 ],
                [ 'Guppy (Goud)' => 12 ],
                [ 'Guppy (Goud)' => -1 ]
            ]
        ];

        foreach ($mutations as $aquariumDesc => $fishMutations) {
            $aquarium = $aquariumManager->findOneByCriteria([ 'description' => $aquariumDesc ]);

            foreach ($fishMutations as $mutation) {
                $fishName = array_keys($mutation)[0];
                $amount   = current($mutation);

                $fish = $fishManager->findOneByName($fishName);

                $aquariumManager->mutate($fish, $aquarium, $amount);
            }
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

}
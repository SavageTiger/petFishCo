<?php

namespace SvenH\PetFishCo\Tests\Functional;

use SvenH\PetFishCo\Tests\WebTestCase;

class ApiInventoryControllerTest extends WebTestCase
{
    protected $expectedMutations = [
        'mutations' => [
            [
                'fish' => ['name' => 'Goudvis'],
                'amount' => 10
            ],
            [
                'fish' => ['name' => 'Goudvis'],
                'amount' => 24
            ],
            [
                'fish' => ['name' => 'Goudvis'],
                'amount' => -8
            ],
            [
                'fish' => ['name' => 'Driebandanemoonvis'],
                'amount' => 20
            ],
            [
                'fish' => ['name' => 'Driebandanemoonvis'],
                'amount' => 11
            ],
            [
                'fish' => ['name' => 'Driebandanemoonvis'],
                'amount' => -17
            ]
        ]
    ];

    public function testApiInventoryList()
    {
        $self        = $this;
        $apiResponse = $this->queryApi('/inventory/list');

        $assertAmounts = function ($description, $amounts, $apiResponse) use ($self) {
            $correct  = 0;
            $aquarium = $self->findAquariumInResponse($description, $apiResponse);

            foreach ($aquarium['inventory'] as $inventoryItem) {
                foreach ($amounts as $amount) {
                    if ($amount === $inventoryItem['amount']) {
                        $correct++;
                    }
                }
            }

            $this->assertSame(count($amounts), $correct);
        };

        $aquarium = $this->findAquariumInResponse('In de wand achterin de winkel', $apiResponse);

        $fields = [
            'description' => 'In de wand achterin de winkel',
            'shape' => 'Inbouw (muur)',
            'glass_type' => 'Optiwhite Clear 12mm',
            'volume' => 500,
            'volume_unit' => 'liters',
            'inventory' => [ ['fish' => ['name' => 'Goudvis']] ]
        ];

        $this->assertArraySubset($fields, $aquarium);

        $this->assertRegExp('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $aquarium['inventory'][0]['fish']['id']);

        $assertAmounts('In de wand achterin de winkel', [26, 14], $apiResponse);
        $assertAmounts('In de wand rechterzijde van de winkel', [41, 7], $apiResponse);
        $assertAmounts('Op de toonbank', [100, 33], $apiResponse);
    }

    public function testInventoryDetails()
    {
        $apiResponse = $this->queryApi('/inventory/list');
        $aquarium    = $this->findAquariumInResponse('In de wand achterin de winkel', $apiResponse);
        $apiResponse = $this->queryApi('/inventory/details/' . $aquarium['id']);

        $expected = array_merge(
            [ 'inventory' => [ ['fish' => ['name' => 'Goudvis']] ] ],
            $this->expectedMutations
        );

        $this->assertRegExp('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $aquarium['inventory'][0]['fish']['id']);
        $this->assertRegExp('/(\d{4})-(\d{2})-(\d{2})T(\d{2})\:(\d{2})\:(\d{2})[+-](\d{2})\:(\d{2})/', $apiResponse['mutations'][0]['timestamp']);
        $this->assertArraySubset($expected, $apiResponse);
    }

    public function testInventoryUpdate()
    {
        $apiResponse = $this->queryApi('/inventory/list');
        $aquarium    = $this->findAquariumInResponse('In de wand achterin de winkel', $apiResponse);
        $apiResponse = $this->queryApi('/inventory/details/' . $aquarium['id']);

        $idFishPrimary   = $aquarium['inventory'][0]['fish']['id'];
        $idFishSecondary = $aquarium['inventory'][1]['fish']['id'];

        $this->assertSame('Goudvis', $aquarium['inventory'][0]['fish']['name']);

        $payload = [
            [ 'fishId' => $idFishPrimary, 'amount' => 33 ],
            [ 'fishId' => $idFishSecondary, 'amount' => 5 ]
        ];

        // Hack: Sleep for a second to make sure that the newly created mutations don't have the same timestamp
        // as the freshly made fixtures, otherwise the ordering might be incorrect.
        sleep(1);

        $apiResponse = $this->queryApi('/inventory/update/' . $apiResponse['id'], $payload, 'PATCH');
        $this->assertSame('Updated inventory', $apiResponse['message']);

        $apiResponse = $this->queryApi('/inventory/details/' . $aquarium['id']);

        $expected = array_merge(
            [
                [ 'fish' => [ 'name' => 'Goudvis' ], 'amount' => 7 ],
                [ 'fish' => [ 'name' => 'Driebandanemoonvis' ], 'amount' => -9 ]
            ],
            $this->expectedMutations['mutations']
        );


        $this->assertArraySubset([ 'mutations' => $expected ], $apiResponse);
    }

    public function testInventoryViolations()
    {
        $apiResponse = $this->queryApi('/inventory/list');
        $aquarium    = $this->findAquariumInResponse('In de wand achterin de winkel', $apiResponse);

        $payload = [ ['fishId' => $this->findFish('Guppy (Goud)')['id'], 'amount' => 1337 ] ];

        $apiResponse = $this->queryApi('/inventory/update/' . $aquarium['id'], $payload, 'PATCH');
        $this->assertSame('"Goldfish don\'t go with guppies"', $apiResponse['message']);

        $apiResponse = $this->queryApi('/inventory/list');
        $aquarium    = $this->findAquariumInResponse('Op de toonbank', $apiResponse);

        $payload = [ ['fishId' => $this->findFish('Driebandanemoonvis')['id'], 'amount' => 42 ] ];

        $apiResponse = $this->queryApi('/inventory/update/' . $aquarium['id'], $payload, 'PATCH');
        $this->assertSame('"Unable to add a fish with more ore equal to 3 fins to a tank containing less then 75 liters of water"', $apiResponse['message']);
    }

    protected function findFish($name)
    {
        $apiResponse = $this->queryApi('/entity/list/fish');

        foreach ($apiResponse as $fish) {
            if ($fish['name'] === $name) {
                return $fish;
            }
        }

        return null;
    }

    protected function findAquariumInResponse($description, $apiResponse) {
        foreach ($apiResponse as $aquarium) {
            if ($aquarium['description'] === $description) {
                return $aquarium;
            }
        }

        return null;
    }
}
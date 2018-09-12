<?php

namespace SvenH\PetFishCo\Tests\Functional;

use SvenH\PetFishCo\Tests\WebTestCase;

class ApiEntityControllerTest extends WebTestCase
{
    public function testApiEntityListFish()
    {
        $expectedFish = [
            [
                'name'   => 'Goudvis',
                'family' => 'Cyprinidae',
                'color'  => 'FF6C00'
            ],
            [
                'name'   => 'Guppy (Goud)',
                'family' => 'Poeciliidae',
                'color'  => 'FF6C00'
            ]
        ];

        $apiResponse = $this->queryApi('/entity/list/fish');

        $this->assertSame(4, count(array_keys($apiResponse[0])));
        $this->assertArraySubset($expectedFish[0], $apiResponse[0]);
        $this->assertArraySubset($expectedFish[1], $apiResponse[2]);
        $this->assertRegExp('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $apiResponse[0]['id']);
    }

    public function testApiEntityListAquariums()
    {
        $expectedAquarium = [
            ['description' => 'In de wand rechterzijde van de winkel'],
            ['description' => 'Op de toonbank'],
        ];

        $apiResponse = $this->queryApi('/entity/list/aquarium');

        $this->assertSame(2, count(array_keys($apiResponse[0])));
        $this->assertArraySubset($expectedAquarium[0], $apiResponse[1]);
        $this->assertArraySubset($expectedAquarium[1], $apiResponse[2]);
        $this->assertRegExp('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $apiResponse[0]['id']);
    }

    public function testApiEntityLoadFish()
    {
        $expected = [
            'name'       => 'Goudvis',
            'latin_name' => 'Carassius gibelio auratus',
            'family'     => 'Cyprinidae',
            'color'      => 'FF6C00',
            'fins'       => 5
        ];

        $list = $this->queryApi('/entity/list/fish');
        $apiResponse = $this->queryApi('/entity/load/fish/' . $list[0]['id']);

        $this->assertSame(7, count(array_keys($apiResponse)));
        $this->assertRegExp('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $apiResponse['id']);
        $this->assertArraySubset($expected, $apiResponse);

        $this->assertSame('goudvis.jpg', $apiResponse['picture']['filename']);
        $this->assertGreaterThan(1024, strlen($apiResponse['picture']['binary']));
    }

    public function testApiEntityLoadAquarium()
    {
        $expected = [
            'description' => 'In de wand achterin de winkel',
            'shape'       => 'Inbouw (muur)',
            'glass_type'  => 'Optiwhite Clear 12mm',
            'volume'      => 500,
            'volume_unit' => 'liters'
        ];

        $list = $this->queryApi('/entity/list/aquarium');
        $apiResponse = $this->queryApi('/entity/load/aquarium/' . $list[0]['id']);

        $this->assertSame(6, count(array_keys($apiResponse)));
        $this->assertRegExp('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $apiResponse['id']);
        $this->assertArraySubset($expected, $apiResponse);
    }

    public function testApiEntityLoad404()
    {
        $response = $this->queryApi('/entity/load/aquarium/404');

        $this->assertSame('Not Found', $response['message']);
    }

    public function testEntityCreateFish()
    {
        $pixel = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==';

        $fields = [
            'name'       => 'Real Big Fish',
            'latin_name' => 'Skabandiii',
            'family'     => 'Pomacentridae',
            'color'      => '3096FF',
            'fins'       => 999,
            'picture'    => [ 'filename' => 'pixel.png', 'binary' => $pixel ]
        ];

        $apiResponse = $this->queryApi('/entity/fish', $fields, 'POST');
        $this->assertSame('Fish was successfully updated', $apiResponse['message']);

        $apiResponse = $this->queryApi('/entity/load/fish/' . $apiResponse['id']);
        $this->assertArraySubset($fields, $apiResponse);
    }

    public function testEntityCreateAquarium()
    {
        $fields = [
            'description' => 'Tiny tank',
            'shape'       => 'Inbouw (muur)',
            'glass_type'  => 'Optiwhite Clear 12mm',
            'volume'      => 1,
            'volume_unit' => 'gallons'
        ];

        $apiResponse = $this->queryApi('/entity/aquarium', $fields, 'POST');
        $this->assertSame('Aquarium was successfully updated', $apiResponse['message']);

        $apiResponse = $this->queryApi('/entity/load/aquarium/' . $apiResponse['id']);
        $this->assertArraySubset($fields, $apiResponse);
    }

    public function testEntityNonExistentType()
    {
        $apiResponse = $this->queryApi('/entity/somethingElse', [], 'POST');
        $this->assertSame('No manager found for requested type', $apiResponse['message']);
    }

    public function testEntityUpdateFish()
    {
        $list = $this->queryApi('/entity/list/fish');
        $apiResponse = $this->queryApi('/entity/load/fish/' . $list[0]['id']);

        $this->assertSame('Goudvis', $apiResponse['name']);
        $this->assertSame('Cyprinidae', $apiResponse['family']);

        $this->queryApi('/entity/fish', ['id' => $list[0]['id'], 'family' => 'Pomacentridae'], 'PATCH');

        $apiResponse = $this->queryApi('/entity/load/fish/' . $list[0]['id']);

        $this->assertSame('Goudvis', $apiResponse['name']);
        $this->assertSame('Pomacentridae', $apiResponse['family']);
    }

    public function testEntityUpdateException()
    {
        $response = $this->queryApi('/entity/fish', '??', 'PATCH');

        $this->assertSame('Incorrect data format', $response['message']);
    }

    public function testEntityUpdateFishViolations()
    {
        $list = $this->queryApi('/entity/list/fish');

        $response = $this->queryApi('/entity/fish', ['id' => $list[0]['id'], 'name' => ''], 'PATCH');
        $this->assertSame('Please provide a name', $response['message']);

        $response = $this->queryApi('/entity/fish', ['id' => $list[0]['id'], 'color' => ''], 'PATCH');
        $this->assertSame('Please provide a valid color (e.g. FFFFFF)', $response['message']);

        $response = $this->queryApi('/entity/fish', ['id' => $list[0]['id'], 'color' => 'BLAAT'], 'PATCH');
        $this->assertSame('Please provide a valid color (e.g. FFFFFF)', $response['message']);

        $response = $this->queryApi('/entity/fish', ['id' => $list[0]['id'], 'fins' => '-10'], 'PATCH');
        $this->assertSame('A fish needs at-least one fin', $response['message']);

        $response = $this->queryApi('/entity/fish', ['id' => $list[0]['id'], 'fins' => null], 'PATCH');
        $this->assertSame('Please provide the amount of fins', $response['message']);

        $response = $this->queryApi('/entity/fish', ['id' => $list[0]['id'], 'family' => 'Invalid'], 'PATCH');
        $this->assertSame('Family is required', $response['message']);
    }

    public function testEntityUpdateFishAquarium()
    {
        $list = $this->queryApi('/entity/list/aquarium');

        $response = $this->queryApi('/entity/aquarium', ['id' => $list[0]['id'], 'description' => ''], 'PATCH');
        $this->assertSame('Please provide a brief description', $response['message']);

        $response = $this->queryApi('/entity/aquarium', ['id' => $list[0]['id'], 'shape' => ''], 'PATCH');
        $this->assertSame('Please set a Shape', $response['message']);

        $response = $this->queryApi('/entity/aquarium', ['id' => $list[0]['id'], 'volume' => null], 'PATCH');
        $this->assertSame('Please provide the volume of the aquarium', $response['message']);

        $response = $this->queryApi('/entity/aquarium', ['id' => $list[0]['id'], 'volume' => -100], 'PATCH');
        $this->assertSame('Aquarium has no volume', $response['message']);

        $response = $this->queryApi('/entity/aquarium', ['id' => $list[0]['id'], 'volume_unit' => 'AlienMetric'], 'PATCH');
        $this->assertSame('Unsupported volume unit (supported is liters and gallons)', $response['message']);
    }
}
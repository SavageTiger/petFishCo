<?php

namespace SvenH\PetFishCo\Tests\Functional;

use SvenH\PetFishCo\Tests\WebTestCase;

class ApiPropertiesControllerTest extends WebTestCase
{
    public function testApiPropertyList()
    {
        $response = $this->queryApi('/properties/list/Fish%20Family');

        $this->assertSame(3, count($response));
        $this->assertContains('Cyprinidae', $response);
        $this->assertContains('Poeciliidae', $response);
        $this->assertContains('Pomacentridae', $response);
    }

    public function testGetTypes()
    {
        $this->assertNotNull($this->getTypeId('Fish Family'));
        $this->assertNotNull($this->getTypeId('Glass'));
        $this->assertNotNull($this->getTypeId('Shape'));
        $this->assertNotNull($this->getTypeId('Restriction'));
        $this->assertNull($this->getTypeId('Cookies'));
    }

    public function testApiUpdatePropertyCreateNew()
    {
        $typeId   = $this->getTypeId('Fish Family');
        $response = $this->queryApi('/properties/update/' . $typeId, ['display_name' => 'I like turtles'], 'POST');

        $this->assertSame('Property was successfully updated', $response['message']);

        $response = $this->queryApi('/properties/list/Fish%20Family');

        $this->assertContains('I like turtles', $response);
    }

    public function testApiUpdatePropertyInvalid()
    {
        $typeId   = $this->getTypeId('Fish Family');
        $response = $this->queryApi('/properties/list/Fish%20Family');

        $response = $this->queryApi('/properties/update/' . $typeId, ['id' =>  array_keys($response)[0], 'display_name' => ''], 'PATCH');
        $this->assertSame('Please provide a name', $response['message']);
    }

    public function testApiUpdateProperty()
    {
        $displayName = 'Angels on the sideline, Puzzled and amused.';
        $typeId      = $this->getTypeId('Fish Family');
        $response    = $this->queryApi('/properties/list/Fish%20Family');

        $this->assertSame(3, count($response));

        $ids = array_keys($response);

        $property = ['id' => $ids[0], 'display_name' => $displayName];

        $response = $this->queryApi('/properties/update/' . $typeId, $property, 'PATCH');

        $this->assertSame('Property was successfully updated', $response['message']);

        $response = $this->queryApi('/properties/list/Fish%20Family');

        $this->assertSame(3, count($response));
        $this->assertContains($displayName, $response);

    }

    public function testApiUpdatePropertyNotFound()
    {
        $typeId   = $this->getTypeId('Fish Family');
        $property = ['id' => '-837487487987182364', 'display_name' => '...'];

        $response = $this->queryApi('/properties/update/' . $typeId, $property, 'PATCH');
        $this->assertSame('Not Found', $response['message']);
    }

    public function testApiRemovePropertyDependencies()
    {
        $response = $this->queryApi('/properties/list/Fish%20Family');

        $response = $this->queryApi('/properties/remove/' . array_keys($response)[0], [], 'POST');
        $this->assertSame('Unable to remove this property. It has parent dependencies.', $response['message']);
    }

    public function testApiRemoveProperty()
    {
        $typeId   = $this->getTypeId('Fish Family');

        $response = $this->queryApi('/properties/list/Fish%20Family');
        $this->assertSame(3, count($response));

        $this->queryApi('/properties/update/' . $typeId, ['display_name' => 'Remove me'], 'POST');

        $response = $this->queryApi('/properties/list/Fish%20Family');
        $this->assertSame(4, count($response));

        $id = array_search('Remove me', $response);

        $this->queryApi('/properties/remove/' . $id, [], 'POST');

        $response = $this->queryApi('/properties/list/Fish%20Family');
        $this->assertSame(3, count($response));
    }

    public function testApiRemovePropertyNotFound()
    {
        $response = $this->queryApi('/properties/remove/-100', [], 'POST');

        $this->assertSame('Not Found', $response['message']);
    }

    protected function getTypeId($name)
    {
        $apiResponse = $this->queryApi('/properties/types');

        foreach ($apiResponse as $type) {
            if ($type['display_name'] === $name) {
                return $type['identifier'];
            }
        }

        return null;
    }
}
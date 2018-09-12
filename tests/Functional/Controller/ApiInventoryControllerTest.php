<?php

namespace SvenH\PetFishCo\Tests\Functional;

use SvenH\PetFishCo\Tests\WebTestCase;

class ApiInventoryControllerTest extends WebTestCase
{
    public function testApiInventoryList()
    {
        $apiResponse = $this->queryApi('/inventory/list');

        die(print_R($apiResponse));
    }
}
<?php

namespace SvenH\PetFishCo\Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use SvenH\PetFishCo\Model\Aquarium;

class AquariumTest extends TestCase
{
    /**
     * @var Aquarium
     */
    protected $model;

    public function setUp()
    {
        $this->model = new Aquarium();
    }

    public function testDescription()
    {
        $this->model->setDescription('A tank that contains water');

        $this->assertSame('A tank that contains water', $this->model->getDescription());
    }

    public function testVolumeConvert()
    {
        $this->model->setVolume(42);
        $this->model->setVolumeUnit('liters');

        $this->assertSame((float) 42, $this->model->getVolume('liters'));
        $this->assertSame((float) 11.095260738627358, $this->model->getVolume('gallons'));

        $this->model->setVolumeUnit('gallons');

        $this->assertSame((float) 158.98680000000002, $this->model->getVolume('liters'));
        $this->assertSame((float) 42, $this->model->getVolume('gallons'));
    }

    public function testSetVolumeException()
    {
        $this->expectExceptionMessage('Invalid unit supplied, accepted units are "liters" and "gallons"');

        $this->model->setVolumeUnit('AlienMatric');
    }

    public function testGetVolumeException()
    {
        $this->expectExceptionMessage('Invalid unit requested, supported units are "liters" and "gallons"');

        $this->model->getVolume('AlienMatric');
    }
}

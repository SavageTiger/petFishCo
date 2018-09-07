<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\ORM\EntityManagerInterface;
use SvenH\PetFishCo\Entity\Fish;
use SvenH\PetFishCo\Model\FishInterface;

/**
 * ORM manager for fish entity
 */
class FishManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * PropertyManager
     */
    protected $propertyManager;

    /**
     * @var PictureManager
     */
    protected $pictureManager;

    /**
     * @param EntityManagerInterface $em
     * @param PropertyManager        $propertyManager
     * @param PictureManager         $pictureManager
     */
    public function __construct(EntityManagerInterface $em, PropertyManager $propertyManager, PictureManager $pictureManager)
    {
        $this->em              = $em;
        $this->propertyManager = $propertyManager;
        $this->pictureManager  = $pictureManager;
    }

    /**
     * Create a fish
     *
     * @param string      $name
     * @param string      $latinName
     * @param int         $finAmount
     * @param string      $family
     * @param string      $color
     * @param string|null $pictureFilename
     * @param string|null $picture
     *
     * @throws \Exception
     *
     * @return FishInterface
     */
    public function createFish(
        string $name, string $latinName, int $finAmount, string $family, string $color,
        string $pictureFilename = null, string $picture = null): FishInterface
    {
        $fish = new Fish();
        $fish->setName($name);
        $fish->setLatinName($latinName);
        $fish->setAmount($finAmount);
        $fish->setColor($color);

        $family = $this->propertyManager->findProperty($family, 'Fish Family');

        if ($family === null) {
            throw new \Exception('Requested fish family was not found');
        }

        $fish->setFamily($family);

        if ($picture !== null) {
            $picture = $this->pictureManager->createPicture($pictureFilename, $picture);

            $fish->setPicture($picture);
        }

        return $fish;
    }

}
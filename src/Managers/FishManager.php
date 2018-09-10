<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\ORM\EntityManagerInterface;
use SvenH\PetFishCo\Entity\Fish;
use SvenH\PetFishCo\Model\FishInterface;
use SvenH\PetFishCo\Model\PropertyInterface;
use SvenH\PetFishCo\ORM\AbstractORMManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Manager for fish entity
 */
class FishManager extends AbstractORMManager
{
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
     * @param ValidatorInterface     $validator
     * @param PropertyManager        $propertyManager
     * @param PictureManager         $pictureManager
     */
    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator, PropertyManager $propertyManager, PictureManager $pictureManager)
    {
        $this->em              = $em;
        $this->validator       = $validator;
        $this->propertyManager = $propertyManager;
        $this->pictureManager  = $pictureManager;
        $this->className       = Fish::class;
    }

    /**
     * Create a fish
     *
     * @param string                   $name
     * @param string                   $latinName
     * @param int                      $finAmount
     * @param string|PropertyInterface $family
     * @param string                   $color
     * @param string|null              $pictureFilename
     * @param string|null              $picture
     *
     * @throws \Exception
     *
     * @return FishInterface
     */
    public function createFish(
        string $name, string $latinName, int $finAmount, $family, string $color,
        string $pictureFilename = null, string $picture = null): FishInterface
    {
        $fish = new Fish();
        $fish->setName($name);
        $fish->setLatinName($latinName);
        $fish->setAmount($finAmount);
        $fish->setColor($color);

        if (($family instanceof PropertyInterface) === false) {
            $family = $this->propertyManager->findProperty($family, 'Fish Family');
        }

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
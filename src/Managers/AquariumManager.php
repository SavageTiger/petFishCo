<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\ORM\EntityManagerInterface;
use SvenH\PetFishCo\Entity\Aquarium;
use SvenH\PetFishCo\Entity\AquariumMutation;
use SvenH\PetFishCo\Model\AquariumInterface;
use SvenH\PetFishCo\Model\FishInterface;
use SvenH\PetFishCo\Model\PropertyInterface;

/**
 * Manager for aquarium entity
 */
class AquariumManager
{
    /**
     * @var PropertyManager
     */
    protected $propertyManager;

    /**
     * @param EntityManagerInterface $em
     * @param PropertyManager        $propertyManager
     */
    public function __construct(EntityManagerInterface $em, PropertyManager $propertyManager)
    {
        $this->em              = $em;
        $this->propertyManager = $propertyManager;
    }

    /**
     * Mutate (add or remove fish) from a aquarium
     *
     * @param FishInterface     $fish
     * @param AquariumInterface $aquarium
     * @param int               $amount
     */
    public function mutate(FishInterface $fish, AquariumInterface $aquarium, int $amount)
    {
        $mutation = new AquariumMutation($fish, $aquarium, $amount);

        $this->em->persist($mutation);
        $this->em->flush();
    }

    /**
     * Create a aquarium
     *
     * @param string                   $description
     * @param string|PropertyInterface $shape
     * @param string|PropertyInterface $glass
     * @param int                      $volume
     *
     * @return AquariumInterface
     * @throws \Exception
     */
    public function createAquarium(string $description, $shape, $glass, int $volume): AquariumInterface
    {
        $aquarium = new Aquarium();

        if (($shape instanceof PropertyInterface) === false) {
            $shape = $this->propertyManager->findProperty($shape, 'Shape');
        }

        if (($glass instanceof PropertyInterface) === false) {
            $glass = $this->propertyManager->findProperty($glass, 'Glass');
        }

        if ($glass === null || $shape === null) {
            throw new \Exception('Glass or Shape property could not be resolved');
        }

        $aquarium->setDescription($description);
        $aquarium->setGlassType($glass);
        $aquarium->setShape($shape);
        $aquarium->setVolume($volume);

        return $aquarium;
    }

    /**
     * Find aquariumInterface by its description
     *
     * @param string $name
     *
     * @return null|AquariumInterface
     */
    public function findOneByDescription(string $description): ?AquariumInterface
    {
        return $this->em->getRepository(Aquarium::class)->findOneBy([ 'description' => $description ]);
    }
}
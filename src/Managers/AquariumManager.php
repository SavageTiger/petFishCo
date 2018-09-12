<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\ORM\EntityManagerInterface;
use SvenH\PetFishCo\Entity\Aquarium;
use SvenH\PetFishCo\Entity\AquariumMutation;
use SvenH\PetFishCo\Model\AquariumInterface;
use SvenH\PetFishCo\Model\PropertyInterface;
use SvenH\PetFishCo\ORM\AbstractORMManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Manager for aquarium entity
 */
class AquariumManager extends AbstractORMManager
{
    /**
     * @var PropertyManager
     */
    protected $propertyManager;

    /**
     * @var FishManager
     */
    protected $fishManager;

    /**
     * @param EntityManagerInterface $em
     * @param ValidatorInterface     $validator
     * @param FishManager            $fishManager
     * @param PropertyManager        $propertyManager
     */
    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator, FishManager $fishManager, PropertyManager $propertyManager)
    {
        $this->em              = $em;
        $this->validator       = $validator;
        $this->fishManager     = $fishManager;
        $this->propertyManager = $propertyManager;
        $this->className       = Aquarium::class;
    }

    /**
     * Mutate (add or remove fish) from an aquarium
     *
     * Calculates state changes and generates mutations
     *
     * Payload format example:
     * [ [ 'fishId' => '...', amount => 123 ], [ ... ], [ ... ]]
     *
     * @param AquariumInterface $aquarium
     * @param array             $payload
     *
     * @throws \Exception
     */
    public function mutate(AquariumInterface $aquarium, array $payload = [])
    {
        $currentState = $aquarium->getInventory();

        $findFish = function (string $fishId) use ($currentState): ?array  {
            foreach ($currentState as $inventoryItem) {
                if ($inventoryItem['fish']->getId() === $fishId) {
                    return $inventoryItem;
                }
            }

            return null;
        };

        foreach ($payload as $inventoryUpdate) {
            $existingFishState = $findFish($inventoryUpdate['fishId']);

            if ($existingFishState !== null) {
                $fish   = $existingFishState['fish'];
                $amount = $existingFishState['amount'];

                $diff = (int) ($inventoryUpdate['amount'] - $amount);
            } else {
                $diff = (int) $inventoryUpdate['amount'];
                $fish = $this->fishManager->findOneById($inventoryUpdate['fishId']);

                if ($fish === null) {
                    throw new \Exception('Fish not found');
                }
            }

            if ($diff !== 0) {
                $mutation = new AquariumMutation($fish, $aquarium, $diff);

                $this->validate($mutation);

                $this->em->persist($mutation);
            }
        }

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
}
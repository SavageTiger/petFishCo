<?php

namespace SvenH\PetFishCo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiEntityController extends AbstractController
{
    /**
     * @Route("/entity/load/{objectType}/{guid}", name="api_load_entity")
     */
    public function apiEntityLoadAction(string $objectType, string $guid)
    {
        $manager = $this->getManager($objectType);
        $entity  = $manager->findOneById($guid);

        if ($entity === null) {
            throw $this->createNotFoundException();
        }

        $serialized = $this->serialize('detail', [ $entity ]);
        $serialized = current($serialized);

        return new JsonResponse($serialized);
    }

    /**
     * @Route("/entity/list/{objectType}", name="api_list_entities")
     */
    public function apiEntityListAction(string $objectType)
    {
        $manager  = $this->getManager($objectType);
        $entities = $manager->findAll();

        return new JsonResponse($this->serialize('list', $entities));
    }
}

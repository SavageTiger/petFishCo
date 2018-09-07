<?php

namespace SvenH\PetFishCo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/load/{objectType}/{guid}", name="api_load_entry")
     */
    public function apiLoadAction(string $objectType, string $guid)
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
     * @Route("/list/{objectType}", name="api_list_entries")
     */
    public function apiListAction(string $objectType)
    {
        $manager  = $this->getManager($objectType);
        $entities = $manager->findAll();

        return new JsonResponse($this->serialize('list', $entities));
    }
}

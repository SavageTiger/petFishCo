<?php

namespace SvenH\PetFishCo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiEntityController extends AbstractController
{
    /**
     * @Route("/entity/load/{objectType}/{guid}", name="api_load_entity", methods={"GET"})
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
     * @Route("/entity/list/{objectType}", name="api_list_entities", methods={"GET"})
     */
    public function apiEntityListAction(string $objectType)
    {
        $manager  = $this->getManager($objectType);
        $entities = $manager->findAll();

        return new JsonResponse($this->serialize('list', $entities));
    }

    /**
     * @Route("/entity/{objectType}", name="api_update_entity", methods={"POST", "PATCH"})
     */
    public function apiEntityUpdateAction(string $objectType, Request $request)
    {
        $manager = $this->getManager($objectType);
        $data = json_decode($request->getContent(), true);

        if (is_array($data) === false) {
            throw new \Exception('Incorrect data format');
        }

        $entity = $this->unserialize($data, $manager->getManagedClass());

        $manager->update($entity);

        return new JsonResponse([ 'id' => $entity->getId(), 'message' => ucfirst($objectType) . ' was successfully updated' ]);
    }
}

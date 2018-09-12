<?php

namespace SvenH\PetFishCo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiInventoryController extends AbstractController
{
    /**
     * @Route("/inventory/list", name="api_inventory_list", methods={"GET"})
     */
    public function apiInventoryListAction()
    {
        $manager = $this->getManager('aquarium');
        $aquaria = $manager->findAll();

        return new JsonResponse($this->serialize('inventory', $aquaria));
    }

    /**
     * @Route("/inventory/details/{aquariumId}", name="api_inventory_details", methods={"GET"})
     */
    public function apiInventoryDetailsAction($aquariumId)
    {
        $manager  = $this->getManager('aquarium');
        $aquarium = $manager->findOneById($aquariumId);

        if ($aquarium === null) {
            throw $this->createNotFoundException();
        }

        return new JsonResponse(current($this->serialize(['inventory', 'mutations'], [ $aquarium ])));
    }

    /**
     * @Route("/inventory/update/{aquariumId}", name="api_inventory_update", methods={"PATCH"})
     */
    public function apiInventoryUpdateAction(Request $request, $aquariumId)
    {
        $manager  = $this->getManager('aquarium');
        $aquarium = $manager->findOneById($aquariumId);

        if ($aquarium === null) {
            throw $this->createNotFoundException();
        }

        $payload = json_decode($request->getContent(), true);

        $manager->mutate($aquarium, $payload);

        return new JsonResponse();
    }
}

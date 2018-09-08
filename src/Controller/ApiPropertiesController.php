<?php

namespace SvenH\PetFishCo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiPropertiesController extends AbstractController
{
    /**
     * @Route("/properties/list/{propertyType}", name="api_list_properties")
     */
    public function apiListPropertiesAction(string $propertyType)
    {
        $buffer  = [];
        $manager = $this->get('petfishco.manager.property');

        $properties = $manager->getAllProperties(
            $manager->getTypeIdByName($propertyType)
        );

        foreach ($properties as $property) {
            $buffer[] = $property->getValue();
        }

        return new JsonResponse($this->serialize('list', $buffer));
    }
}

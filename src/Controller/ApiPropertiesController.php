<?php

namespace SvenH\PetFishCo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiPropertiesController extends AbstractController
{
    /**
     * @Route("/properties/update/{typeIdentifier}", name="api_update_property", methods={"POST", "PATCH"})
     */
    public function apiUpdatePropertyAction(Request $request, int $typeIdentifier)
    {
        $manager = $this->get('petfishco.manager.property');

        $property = json_decode($request->getContent(), true);

        if ($request->getMethod() === 'PATCH') {
            $propertyEntity = $manager->getPropertyById($property['id']);

            if ($propertyEntity === null) {
                throw $this->createNotFoundException();
            }

            $property = $manager->updatePropertyDisplayName($propertyEntity , $property['display_name']);
        } elseif ($request->getMethod() === 'POST') {
            $property = $manager->createProperty($property['display_name'], $typeIdentifier, true);
        }

        return new JsonResponse(['id' => $property->getId(), 'message' => 'Property was successfully updated']);
    }

    /**
     * @Route("/properties/remove/{id}", name="api_remove_property", methods={"POST"})
     */
    public function apiRemovePropertyAction(int $id)
    {
        $manager        = $this->get('petfishco.manager.property');
        $propertyEntity = $manager->getPropertyById($id);

        if ($propertyEntity === null) {
            throw $this->createNotFoundException();
        }

        $manager->removeProperty($propertyEntity);

        return new JsonResponse(['message' => 'Property was successfully removed']);
    }


    /**
     * @Route("/properties/list/{propertyType}", name="api_list_properties", methods={"GET"})
     */
    public function apiListPropertiesAction(string $propertyType)
    {
        $buffer  = [];
        $manager = $this->get('petfishco.manager.property');

        $properties = $manager->getAllProperties(
            $manager->getTypeIdByName($propertyType)
        );

        foreach ($properties as $property) {
            $buffer[$property->getId()] = $property->getValue();
        }

        return new JsonResponse($buffer);
    }

    /**
     * @Route("/properties/types", name="api_list_property_types", methods={"GET"})
     */
    public function apiListPropertyTypesAction()
    {
        $manager        = $this->get('petfishco.manager.property');
        $availableTypes = $manager->getAvailableTypes();
        $buffer         = [];

        foreach ($availableTypes as $typeIdentifier => $type) {
            $buffer[] = [
                'identifier' => $typeIdentifier, 'display_name' => $type
            ];
        }

        return new JsonResponse($buffer);
    }

}

<?php

namespace SvenH\PetFishCo\Controller;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use SvenH\PetFishCo\ORM\AbstractORMManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{
    /**
     * Transform entity objects into arrays using serialization
     *
     * @param string|array $context
     * @param mixed        $data
     *
     * @return array
     */
    protected function serialize($context = 'list', $data): array
    {
        $serializer        = $this->get('jms_serializer');
        $serializerContext = new SerializationContext();
        $serializerContext->setGroups($context);

        $json = $serializer->serialize($data, 'json', $serializerContext);

        return json_decode($json);
    }

    /**
     * Transform array into entity
     *
     * @param array  $data
     * @param string $type
     *
     * @return mixed
     */
    protected function unserialize(array $data, string $type)
    {
        $serializer        = $this->get('jms_serializer');
        $serializerContext = new DeserializationContext();

        return $serializer->deserialize(
            json_encode($data), $type, 'json', $serializerContext
        );
     }

    /**
     * Get object manager from the container
     *
     * @param string $objectType
     *
     * @throws \InvalidArgumentException
     * @return AbstractORMManager
     */
    protected function getManager(string $objectType): AbstractORMManager
    {
        if ($this->has('petfishco.manager.' . $objectType) === false)
        {
            throw new \InvalidArgumentException('No manager found for requested type');
        }

        return $this->get('petfishco.manager.' . $objectType);
    }
}

<?php

namespace SvenH\PetFishCo\Controller;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use SvenH\PetFishCo\Managers\AbstractORMManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractController extends Controller
{
    /**
     * Transform entity objects into arrays using serialization
     *
     * @param string $context
     * @param mixed  $data
     *
     * @return array
     *
     * @throws AnnotationException
     */
    protected function serialize($context = 'list', $data): array
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $encoders    = [ new JsonEncoder() ];
        $normalizers = [ new ObjectNormalizer($classMetadataFactory) ];

        $serializer  = new Serializer($normalizers, $encoders);
        $context     = ['groups' => [$context]];

        return json_decode($serializer->serialize($data, 'json', $context));
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

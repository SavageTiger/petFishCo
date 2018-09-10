<?php

namespace SvenH\PetFishCo\ORM;

use JMS\Serializer\Construction\DoctrineObjectConstructor as BaseDoctrineObjectContructor;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\VisitorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class DoctrineObjectConstructor extends BaseDoctrineObjectContructor
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Inject request object
     *
     * @param RequestStack $request
     */
    public function setRequest(RequestStack $request)
    {
        $this->request = $request->getCurrentRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function construct(VisitorInterface $visitor, ClassMetadata $metadata, $data, array $type, DeserializationContext $context)
    {
        if ($this->request->getMethod() === 'PATCH') {
            $object = parent::construct($visitor, $metadata, $data, $type, $context);

            if ($object === null) {
                throw new \Exception('Unable to load entity');
            }

        }

        if ($this->request->getMethod() === 'POST') {
            $object = new $type['name'];
        }

        return $object;
    }
}
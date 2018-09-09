<?php

namespace SvenH\PetFishCo\Listener;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception     = $event->getException();
        $acceptedTypes = $event->getRequest()->getAcceptableContentTypes();

        if (in_array('application/json', $acceptedTypes) === true) {
            $event->setResponse(new JsonResponse([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]));
        }
    }
}
<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        
        // Obtenir le code HTTP de l'exception
        $code = $exception->getCode() ?: 500;
        if ($code < 100 || $code >= 600) {
            $code = 500;
        }
        
        // Créer une réponse JSON
        $response = new JsonResponse([
            'error' => $exception->getMessage(),
            'code' => $code,
        ], $code);
        
        $event->setResponse($response);
    }
}

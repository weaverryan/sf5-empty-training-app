<?php

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ApiAuditSubscriber implements EventSubscriberInterface
{
    private $logger;
    private $requestStack;

    public function __construct(LoggerInterface $logger, RequestStack $requestStack)
    {
        $this->logger = $logger;
        $this->requestStack = $requestStack;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        //$request = $event->getRequest();
        $request = $this->requestStack->getCurrentRequest();

        if (!str_starts_with($request->getPathInfo(), '/api')) {
            return;
        }

        $this->logger->info('Hi Mom!');
    }

    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => 'onKernelRequest'
        ];
    }
}

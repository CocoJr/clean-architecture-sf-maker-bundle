<?php

namespace CocoJr\CleanArchitectureSfMakerBundle\Service;

use CocoJr\CleanArchitecture\Business\Response\AbstractResponse;
use CocoJr\CleanArchitecture\Business\Service\EventDispatcherInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

final class EventDispatcher extends AbstractDispatcher implements EventDispatcherInterface
{
    public function __construct(MessageBusInterface $eventBus)
    {
        parent::__construct($eventBus);
    }

    /**
     * @param object|Envelope $envelope
     * @return null
     */
    public function getResult(object $envelope): ?AbstractResponse
    {
        return null;
    }
}

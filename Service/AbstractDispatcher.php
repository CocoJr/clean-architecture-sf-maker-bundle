<?php

namespace CocoJr\CleanArchitectureSfMakerBundle\Service;

use Business\AbstractMessage;
use Business\AbstractResponse;
use Business\Domain\Service\DispatcherInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

abstract class AbstractDispatcher implements DispatcherInterface
{
    protected MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function dispatch(AbstractMessage $message): Envelope
    {
        return $this->bus->dispatch($message, []);
    }

    /**
     * @param object|Envelope $envelope
     * @return AbstractResponse
     */
    public function getResult(object $envelope): ?AbstractResponse
    {
        return $envelope
            ->last(HandledStamp::class)
            ->getResult();
    }

    public function dispatchAndGetResult(AbstractMessage $message): ?AbstractResponse
    {
        return $this->getResult($this->dispatch($message));
    }
}

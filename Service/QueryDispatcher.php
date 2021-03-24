<?php

namespace CocoJr\CleanArchitectureSfMakerBundle\Service;

use Business\Domain\Service\QueryDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class QueryDispatcher extends AbstractDispatcher implements QueryDispatcherInterface
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }
}

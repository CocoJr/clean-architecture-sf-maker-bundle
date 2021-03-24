<?php

namespace CocoJr\CleanArchitectureSfMakerBundle\Service;

use CocoJr\CleanArchitecture\Business\Service\QueryDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class QueryDispatcher extends AbstractDispatcher implements QueryDispatcherInterface
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }
}

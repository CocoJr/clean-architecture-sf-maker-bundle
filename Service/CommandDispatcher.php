<?php

namespace CocoJr\CleanArchitectureSfMakerBundle\Service;

use CocoJr\CleanArchitecture\Business\Service\CommandDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandDispatcher extends AbstractDispatcher implements CommandDispatcherInterface
{
    public function __construct(MessageBusInterface $commandBus)
    {
        parent::__construct($commandBus);
    }
}

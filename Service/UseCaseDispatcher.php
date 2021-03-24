<?php

namespace CocoJr\CleanArchitectureSfMakerBundle\Service;

use CocoJr\CleanArchitecture\Business\Service\UseCaseDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class UseCaseDispatcher extends AbstractDispatcher implements UseCaseDispatcherInterface
{
    public function __construct(MessageBusInterface $usecaseBus)
    {
        parent::__construct($usecaseBus);
    }
}

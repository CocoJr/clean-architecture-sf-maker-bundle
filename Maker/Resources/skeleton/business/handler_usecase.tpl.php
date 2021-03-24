<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Business\Abstract<?= $messageType.$type; ?>;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Message\<?= $functionnalityName; ?>Message;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Response\<?= $functionnalityName; ?>Response;
use Business\Domain\Service\CommandDispatcherInterface;
use Business\Domain\Service\QueryDispatcherInterface;
use Business\Domain\Service\EventDispatcherInterface;

final class <?= $class_name; ?> extends Abstract<?= $messageType.$type."\n"; ?>
{
    public function __construct(CommandDispatcherInterface $commandDispatcher, QueryDispatcherInterface $queryDispatcher, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($commandDispatcher, $queryDispatcher, $eventDispatcher);
    }

    public function __invoke(<?= $functionnalityName; ?>Message $message): <?= $functionnalityName; ?>Response
    {
        $response = new <?= $functionnalityName; ?>Response();

        return $response;
    }
}

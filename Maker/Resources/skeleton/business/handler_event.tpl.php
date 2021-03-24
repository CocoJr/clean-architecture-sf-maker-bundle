<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Business\Abstract<?= $messageType.$type; ?>;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Message\<?= $functionnalityName; ?>Message;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Response\<?= $functionnalityName; ?>Response;
use Business\Domain\Service\CommandDispatcherInterface;
use Business\Domain\Service\QueryDispatcherInterface;

final class <?= $class_name; ?> extends Abstract<?= $messageType.$type."\n"; ?>
{
    protected CommandDispatcherInterface $commandDispatcher;
    protected QueryDispatcherInterface $queryDispatcher;

    public function __construct(CommandDispatcherInterface $commandDispatcher, QueryDispatcherInterface $queryDispatcher)
    {
        $this->commandDispatcher = $commandDispatcher;
        $this->queryDispatcher = $queryDispatcher;
    }

    public function __invoke(<?= $functionnalityName; ?>Message $message): void
    {
    }
}

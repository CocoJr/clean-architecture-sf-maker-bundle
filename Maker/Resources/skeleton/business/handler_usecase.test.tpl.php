<?= "<?php declare(strict_types=1);\n" ?>

namespace <?= $namespace; ?>;

use Business\<?= $domain; ?>\<?= $messageType; ?>\Handler\<?= $functionnalityName; ?>Handler;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Message\<?= $functionnalityName; ?>Message;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Request\<?= $functionnalityName; ?>Request;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Response\<?= $functionnalityName; ?>Response;
use Business\Domain\Service\UseCaseDispatcherInterface;
use Business\Domain\Service\CommandDispatcherInterface;
use Business\Domain\Service\QueryDispatcherInterface;
use Business\Domain\Service\EventDispatcherInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Business\Test\TestCase;

final class <?= $class_name; ?> extends TestCase
{
    /** @var MockObject|CommandDispatcherInterface */
    protected CommandDispatcherInterface $commandDispatcher;
    /** @var MockObject|QueryDispatcherInterface */
    protected QueryDispatcherInterface $queryDispatcher;
    /** @var MockObject|EventDispatcherInterface */
    protected EventDispatcherInterface $eventDispatcher;

    public function test<?= $functionnalityName; ?>Success(): void
    {
        // Request
        $request = new <?= $functionnalityName; ?>Request();

        // Mock dependency & assert expected (or not) method call in same time.
        // Use callback in willReturn to assert parameter send in function

        // Call the method
        $response = $this->get<?= $messageType; ?>Response($request);

        // Expected response
        $this->assertTrue($response->isSuccess());
    }

    public function test<?= $functionnalityName; ?>Error(): void
    {
        // Request
        $request = new <?= $functionnalityName; ?>Request();

        // Mock dependency & assert expected (or not) method call in same time.
        // Use callback in willReturn to assert parameter send in function

        // Call the method
        $response = $this->get<?= $messageType; ?>Response($request);

        // Expected response
        $this->assertFalse($response->isSuccess());
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Create the basic mock
        $this->commandDispatcher = $this->getMock(CommandDispatcherInterface::class);
        $this->queryDispatcher = $this->getMock(QueryDispatcherInterface::class);
        $this->eventDispatcher = $this->getMock(EventDispatcherInterface::class);
    }

    private function get<?= $messageType; ?>Response(<?= $functionnalityName; ?>Request $request): <?= $functionnalityName; ?>Response
    {
        $message = new <?= $functionnalityName; ?>Message($request);
        $handler = new <?= $functionnalityName; ?>Handler($this->commandDispatcher, $this->queryDispatcher, $this->eventDispatcher);

        return $handler($message);
    }
}

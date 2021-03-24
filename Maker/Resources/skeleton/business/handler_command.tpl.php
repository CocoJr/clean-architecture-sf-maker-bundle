<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Business\Abstract<?= $messageType.$type; ?>;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Message\<?= $functionnalityName; ?>Message;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Response\<?= $functionnalityName; ?>Response;

final class <?= $class_name; ?> extends Abstract<?= $messageType.$type."\n"; ?>
{
    public function __construct()
    {
    }

    public function __invoke(<?= $functionnalityName; ?>Message $message): <?= $functionnalityName; ?>Response
    {
        $response = new <?= $functionnalityName; ?>Response();

        return $response;
    }
}

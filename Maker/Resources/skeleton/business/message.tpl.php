<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Business\Abstract<?= $messageType.$type; ?>;
use Business\<?= $domain; ?>\<?= $messageType; ?>\Request\<?= $functionnalityName; ?>Request;

/**
 * @method <?= $functionnalityName; ?>Request getRequest()
 */
final class <?= $class_name; ?> extends Abstract<?= $messageType.$type."\n"; ?>
{
    public static function createMessage()
    {
        $request = new <?= $functionnalityName; ?>Request();

        return new <?= $class_name; ?>($request);
    }
}

<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

function (\DateTimeInterface $left, \DateTimeInterface $right)
{
    if ($left < $right) {
        $result = 'before';
    }

    if ($left > $right) {
        $result = 'after';
    }

    if ($left <= $right) {
        $result = 'before or equal';
    }

    if ($left >= $right) {
        $result = 'after or equal';
    }

    if ($left == $right) {
        $result = 'equal';
    }
}
?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

function (\DateTimeInterface $left, \DateTimeInterface $right)
{
    if ($left->isBefore($right)) {
        $result = 'before';
    }

    if ($left->isAfter($right)) {
        $result = 'after';
    }

    if ($left->isBeforeOrEqual($right)) {
        $result = 'before or equal';
    }

    if ($left->isAfterOrEqual($right)) {
        $result = 'after or equal';
    }

    if ($left->isEqual($right)) {
        $result = 'equal';
    }
}
?>
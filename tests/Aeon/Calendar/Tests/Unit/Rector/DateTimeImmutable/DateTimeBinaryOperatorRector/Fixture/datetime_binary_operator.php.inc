<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

class ClassTest
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable('2020-01-01');
    }
}

function test()
{
    $left = new \DateTime('-1 day');
    $right = new \DateTime('+1 day');

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

    if ($left <=> $right) {
        $result = 'equal';
    }

    if ($left->toDateTimeImmutable() <=> $right->toDateTimeImmutable()) {
        $result = 'equal';
    }

    $fn = fn (ClassTest $a, ClassTest $b) : int => $a->date()->toDateTimeImmutable() <=> $b->date()->toDateTimeImmutable();

    if ($left == $right) {
        $result = 'equal';
    }
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

class ClassTest
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable('2020-01-01');
    }
}

function test()
{
    $left = new \DateTime('-1 day');
    $right = new \DateTime('+1 day');

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

    if ($left->toDateTimeImmutable() <=> $right->toDateTimeImmutable()) {
        $result = 'equal';
    }

    if ($left->toDateTimeImmutable() <=> $right->toDateTimeImmutable()) {
        $result = 'equal';
    }

    $fn = fn (ClassTest $a, ClassTest $b) : int => $a->date()->toDateTimeImmutable() <=> $b->date()->toDateTimeImmutable();

    if ($left->isEqual($right)) {
        $result = 'equal';
    }
}

?>
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

class Something
{
    public function left() : \DateTimeImmutable
    {
        return new \DateTimeImmutable('-1 day');
    }

    public function right() : \DateTimeImmutable
    {
        return new \DateTimeImmutable('-1 day');
    }
}

$something = new Something();

if ($something->left() < $something->right()) {
    $result = 'before';
}

if ($something->left() > $something->right()) {
    $result = 'after';
}

if ($something->left() <= $something->right()) {
    $result = 'before or equal';
}

if ($something->left() >= $something->right()) {
    $result = 'after or equal';
}

if ($something->left() == $something->right()) {
    $result = 'equal';
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

class Something
{
    public function left() : \DateTimeImmutable
    {
        return new \DateTimeImmutable('-1 day');
    }

    public function right() : \DateTimeImmutable
    {
        return new \DateTimeImmutable('-1 day');
    }
}

$something = new Something();

if ($something->left()->isBefore($something->right())) {
    $result = 'before';
}

if ($something->left()->isAfter($something->right())) {
    $result = 'after';
}

if ($something->left()->isBeforeOrEqual($something->right())) {
    $result = 'before or equal';
}

if ($something->left()->isAfterOrEqual($something->right())) {
    $result = 'after or equal';
}

if ($something->left()->isEqual($something->right())) {
    $result = 'equal';
}

?>
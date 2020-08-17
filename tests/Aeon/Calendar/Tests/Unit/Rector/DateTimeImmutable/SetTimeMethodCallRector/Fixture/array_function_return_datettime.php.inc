<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\Fixture;

class Foo
{
    public function date() : \DateTimeInterface
    {
        return \DateTimeImmutable('2020-01-01');
    }
}

/**
 * @psalm-var array<int, Foo>
 * @var Foo[] $array
 */
$array = [
    new Foo(),
    new Foo()
];

if (false === true) {
    \current($array)->date()->setTime(0, 0, 0, 0);
    \current($array)->date()->setTime(0, 0);
    (new \DateTimeImmutable())->setTime(new \Aeon\Calendar\Gregorian\Time(0, 0, 0, 0));
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\Fixture;

class Foo
{
    public function date() : \DateTimeInterface
    {
        return \DateTimeImmutable('2020-01-01');
    }
}

/**
 * @psalm-var array<int, Foo>
 * @var Foo[] $array
 */
$array = [
    new Foo(),
    new Foo()
];

if (false === true) {
    \current($array)->date()->setTime(new \Aeon\Calendar\Gregorian\Time(0, 0, 0, 0));
    \current($array)->date()->setTime(new \Aeon\Calendar\Gregorian\Time(0, 0));
    (new \DateTimeImmutable())->setTime(new \Aeon\Calendar\Gregorian\Time(0, 0, 0, 0));
}

?>
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ArgumentTypeToAeonDateTimeRector\Fixture;

class SomeClass
{
    public function __construct(\DateTimeImmutable $dateTimeImmutable, int $int, \DateTimeImmutable $dateTimeImmutable2)
    {
    }

    public function firstArgument(\DateTimeImmutable $dateTimeImmutable) : void
    {
    }
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ArgumentTypeToAeonDateTimeRector\Fixture;

class SomeClass
{
    public function __construct(\Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable, int $int, \Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable2)
    {
    }

    public function firstArgument(\Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable) : void
    {
    }
}

?>
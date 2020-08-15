<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ArgumentTypeToAeonDateTimeRector\Fixture;

function some_function(\DateTimeImmutable $dateTimeImmutable, int $int, \DateTimeImmutable $dateTimeImmutable2) : void
{
}

function first_argument_function(\DateTimeImmutable $dateTimeImmutable) : void
{
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ArgumentTypeToAeonDateTimeRector\Fixture;

function some_function(\Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable, int $int, \Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable2) : void
{
}

function first_argument_function(\Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable) : void
{
}

?>
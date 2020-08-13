<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ClassDateTimePropertyToAeonDateTimeRector\Fixture;

class WithDateTimeInterface
{
    private \DateTimeInterface $dateTime;
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ClassDateTimePropertyToAeonDateTimeRector\Fixture;

class WithDateTimeInterface
{
    private \Aeon\Calendar\Gregorian\DateTime $dateTime;
}

?>
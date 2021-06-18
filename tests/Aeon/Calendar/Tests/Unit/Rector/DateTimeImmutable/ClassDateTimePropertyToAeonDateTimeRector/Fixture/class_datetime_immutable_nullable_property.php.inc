<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ClassDateTimePropertyToAeonDateTimeRector\Fixture;

class WithDateTimeImmutable
{
    private ?\DateTimeImmutable $dateTime;
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ClassDateTimePropertyToAeonDateTimeRector\Fixture;

class WithDateTimeImmutable
{
    private ?\Aeon\Calendar\Gregorian\DateTime $dateTime;
}

?>
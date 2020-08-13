<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ClassDateTimePropertyToAeonDateTimeRector\Fixture;

class WithDateTime
{
    private \DateTime $dateTime;
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ClassDateTimePropertyToAeonDateTimeRector\Fixture;

class WithDateTime
{
    private \Aeon\Calendar\Gregorian\DateTime $dateTime;
}

?>
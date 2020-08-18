<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

function diff_days()
{
    $diffDays = (new \DateTimeImmutable('2020-01-01 00:00:00'))->diff(new \DateTimeImmutable('2020-01-02 00:00:00'))->days;
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

function diff_days()
{
    $diffDays = (new \DateTimeImmutable('2020-01-01 00:00:00'))->distanceUntil(new \DateTimeImmutable('2020-01-02 00:00:00'))->inDaysAbs();
}

?>
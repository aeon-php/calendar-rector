<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

function (\DateTimeInterface $dateTime)
{
    $dateTime->getTimestamp();
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

function (\DateTimeInterface $dateTime)
{
    $dateTime->timestampUNIX()->inSeconds();
}

?>
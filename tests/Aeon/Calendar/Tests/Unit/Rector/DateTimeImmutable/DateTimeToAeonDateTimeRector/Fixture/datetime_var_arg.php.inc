<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$now = 'now';
$tz = 'UTC';
$dateTime = new \DateTime($now);
$dateTime = new \DateTime($now, new \DateTimeZone($tz));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$now = 'now';
$tz = 'UTC';
$dateTime = \Aeon\Calendar\Gregorian\GregorianCalendar::systemDefault()->now();
$dateTime = (new \Aeon\Calendar\Gregorian\GregorianCalendar(new \DateTimeZone($tz)))->now();

?>
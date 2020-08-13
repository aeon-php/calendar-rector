<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = new \DateTime('NOW', new \DateTimeZone('Europe/Warsaw'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$calendar = new \Aeon\Calendar\Gregorian\GregorianCalendar(new \Aeon\Calendar\Gregorian\TimeZone('Europe/Warsaw'));
$dateTime = $calendar->now();

?>
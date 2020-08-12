<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ToAeonDateTimeRector\Fixture;

$dateTime = new \DateTimeImmutable('NOW', new \DateTimeZone('Europe/Warsaw'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ToAeonDateTimeRector\Fixture;

$calendar = new \Aeon\Calendar\Gregorian\GregorianCalendar(new \Aeon\Calendar\Gregorian\TimeZone('Europe/Warsaw'));
$dateTime = $calendar->now();

?>
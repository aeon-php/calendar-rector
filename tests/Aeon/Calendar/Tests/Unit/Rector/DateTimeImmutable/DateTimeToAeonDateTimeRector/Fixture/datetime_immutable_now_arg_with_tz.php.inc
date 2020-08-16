<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = new \DateTimeImmutable('NOW', new \DateTimeZone('Europe/Warsaw'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = (new \Aeon\Calendar\Gregorian\GregorianCalendar(new \DateTimeZone('Europe/Warsaw')))->now();

?>
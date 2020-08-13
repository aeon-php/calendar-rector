<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ToAeonDateTimeRector\Fixture;

$dateTime = new \DateTime('2020-01-01 00:00:01', new \DateTimeZone('Europe/Warsaw'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ToAeonDateTimeRector\Fixture;

$dateTime = \Aeon\Calendar\Gregorian\DateTime::fromString('2020-01-01 00:00:01')->toTimeZone(new \Aeon\Calendar\Gregorian\TimeZone('Europe/Warsaw'));

?>
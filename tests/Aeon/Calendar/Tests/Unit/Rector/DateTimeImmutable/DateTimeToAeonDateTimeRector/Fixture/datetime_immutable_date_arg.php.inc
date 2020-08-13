<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = new \DateTimeImmutable('2020-01-01 00:00:01');

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = \Aeon\Calendar\Gregorian\DateTime::fromString('2020-01-01 00:00:01');

?>
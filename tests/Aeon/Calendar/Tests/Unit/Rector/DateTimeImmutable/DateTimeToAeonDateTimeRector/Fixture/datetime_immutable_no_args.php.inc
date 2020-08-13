<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = new \DateTimeImmutable();

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = \Aeon\Calendar\Gregorian\GregorianCalendar::systemDefault()->now();

?>
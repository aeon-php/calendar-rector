<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = new \DateTime();

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$dateTime = \Aeon\Calendar\Gregorian\GregorianCalendar::systemDefault()->now();

?>
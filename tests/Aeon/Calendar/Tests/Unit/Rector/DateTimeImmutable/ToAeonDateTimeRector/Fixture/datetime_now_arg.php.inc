<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ToAeonDateTimeRector\Fixture;

$dateTime = new \DateTime('NOW');

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ToAeonDateTimeRector\Fixture;

$dateTime = \Aeon\Calendar\Gregorian\GregorianCalendar::systemDefault()->now();

?>
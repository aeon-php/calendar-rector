<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->setTime(0, 0, 0, 0);

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->setTime(new \Aeon\Calendar\Gregorian\Time(0, 0, 0, 0));

?>
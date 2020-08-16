<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetDateMethodCallRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->setDate(0, 0, 0);

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetDateMethodCallRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->setDate(\Aeon\Calendar\Gregorian\Day::create(0, 0, 0));

?>
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->setTimezone(new \DateTimeZone('UTC'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->toTimeZone(new \DateTimeZone('UTC'));

?>
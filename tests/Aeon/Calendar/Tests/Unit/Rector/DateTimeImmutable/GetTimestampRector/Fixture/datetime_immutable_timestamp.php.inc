<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->getTimestamp();

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->getTimestamp()->inSeconds();

?>
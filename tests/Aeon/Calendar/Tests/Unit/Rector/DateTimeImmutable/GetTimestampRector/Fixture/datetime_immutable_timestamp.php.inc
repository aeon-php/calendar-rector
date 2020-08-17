<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime2 = new \DateTimeImmutable();
$dateTime->getTimestamp() === $dateTime2->getTimestamp();


?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime2 = new \DateTimeImmutable();
$dateTime->timestampUNIX()->inSeconds() === $dateTime2->timestampUNIX()->inSeconds();

?>
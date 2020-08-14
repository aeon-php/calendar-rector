<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

$dateTime = new \DateTime();
$dateTime->getTimestamp();

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\GetTimestampRector\Fixture;

$dateTime = new \DateTime();
$dateTime->getTimestamp()->inSeconds();

?>
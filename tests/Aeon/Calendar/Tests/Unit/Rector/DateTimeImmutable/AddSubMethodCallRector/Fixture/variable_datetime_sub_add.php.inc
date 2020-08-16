<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\_Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->sub(\DateInterval::createFromDateString('10 minutes'));
$dateTime->add(\DateInterval::createFromDateString('10 minutes'));

$dateTime->sub(new \DateInterval('PT1H'));
$dateTime->add(new \DateInterval('PT1H'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\_Fixture;

$dateTime = new \DateTimeImmutable();
$dateTime->sub(\Aeon\Calendar\TimeUnit::fromDateInterval(\DateInterval::createFromDateString('10 minutes')));
$dateTime->add(\Aeon\Calendar\TimeUnit::fromDateInterval(\DateInterval::createFromDateString('10 minutes')));

$dateTime->sub(\Aeon\Calendar\TimeUnit::fromDateInterval(new \DateInterval('PT1H')));
$dateTime->add(\Aeon\Calendar\TimeUnit::fromDateInterval(new \DateInterval('PT1H')));

?>
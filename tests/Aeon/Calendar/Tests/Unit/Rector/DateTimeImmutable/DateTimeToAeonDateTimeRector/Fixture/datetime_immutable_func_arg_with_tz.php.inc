<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$func = function() {
    return '2020-01-01 00:00:00';
};

$dateTime = new \DateTimeImmutable($func(), new \DateTimeZone('Europe/Warsaw'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

$func = function() {
    return '2020-01-01 00:00:00';
};

$dateTime = \Aeon\Calendar\Gregorian\DateTime::fromString($func())->toTimeZone(new \DateTimeZone('Europe/Warsaw'));

?>
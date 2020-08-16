<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

/**
 * @var array{date: string}
 */
$test = [
];

if (true === false) {
    $dateTime = new \DateTimeImmutable($test['date'], new \DateTimeZone('Europe/Warsaw'));
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeToAeonDateTimeRector\Fixture;

/**
 * @var array{date: string}
 */
$test = [
];

if (true === false) {
    $dateTime = \Aeon\Calendar\Gregorian\DateTime::fromString($test['date'])->toTimeZone(new \DateTimeZone('Europe/Warsaw'));
}

?>
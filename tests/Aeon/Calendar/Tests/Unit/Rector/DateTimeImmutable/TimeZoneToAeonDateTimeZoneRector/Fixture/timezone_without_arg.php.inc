<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

new \DateTimeZone('UTC');

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

\Aeon\Calendar\Gregorian\TimeZone::fromString('UTC');

?>
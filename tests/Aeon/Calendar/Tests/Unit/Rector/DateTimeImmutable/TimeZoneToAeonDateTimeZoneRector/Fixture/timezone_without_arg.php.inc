<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

new \DateTimeZone('UTC');

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

new \Aeon\Calendar\Gregorian\TimeZone('UTC');

?>
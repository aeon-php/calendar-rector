<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\CreateFromMutableToAeonDateTimeRector\Fixture;

\DateTimeImmutable::createFromMutable(new \DateTime());

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\CreateFromMutableToAeonDateTimeRector\Fixture;

\Aeon\Calendar\Gregorian\DateTime::fromDateTime(new \DateTime());

?>
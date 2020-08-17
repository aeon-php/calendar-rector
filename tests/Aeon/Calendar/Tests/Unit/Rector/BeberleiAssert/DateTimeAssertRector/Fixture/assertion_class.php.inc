<?php

namespace Aeon\Calendar\Tests\Unit\Rector\BeberleiAssert\DateTimeAssertRector\Fixture;

use Assert\Assertion;
use DateTime;

class Test
{
    public function __construct(DateTime $start, DateTime $end)
    {
        Assertion::lessThan($start, $end, 'test');
    }
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\BeberleiAssert\DateTimeAssertRector\Fixture;

use Assert\Assertion;
use DateTime;

class Test
{
    public function __construct(DateTime $start, DateTime $end)
    {
        Assertion::true($start->isBefore($end), 'test');
    }
}

?>
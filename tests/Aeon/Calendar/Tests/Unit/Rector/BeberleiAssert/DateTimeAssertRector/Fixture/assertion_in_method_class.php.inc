<?php

namespace Aeon\Calendar\Tests\Unit\Rector\BeberleiAssert\DateTimeAssertRector\Fixture;

use Assert\Assertion;
use DateTime;

class Test
{
    private const TEST = 1;

    public function __construct(DateTime $start, DateTime $end)
    {
        Assertion::lessThan($start, $end, 'test');
        Assertion::lessThan($start, self::TEST, 'test');
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
    private const TEST = 1;

    public function __construct(DateTime $start, DateTime $end)
    {
        Assertion::true($start->isBefore($end), 'test');
        Assertion::lessThan($start, self::TEST, 'test');
    }
}

?>
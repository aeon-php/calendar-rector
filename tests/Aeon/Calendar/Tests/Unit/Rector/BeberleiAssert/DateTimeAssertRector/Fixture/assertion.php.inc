<?php

namespace Aeon\Calendar\Tests\Unit\Rector\BeberleiAssert\DateTimeAssertRector\Fixture;

if (true === false) {
    \Assert\Assertion::eq(new \DateTimeImmutable('now'), new \DateTimeImmutable('now'));
    \Assert\Assertion::eq(1, 2);
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\BeberleiAssert\DateTimeAssertRector\Fixture;

if (true === false) {
    \Assert\Assertion::true((new \DateTimeImmutable('now'))->isEqual(new \DateTimeImmutable('now')));
    \Assert\Assertion::eq(1, 2);
}

?>
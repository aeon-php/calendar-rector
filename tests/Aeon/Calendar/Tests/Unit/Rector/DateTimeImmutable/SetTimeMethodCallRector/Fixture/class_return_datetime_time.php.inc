<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\Fixture;

class Something
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}

$something = new Something();

$something->date()->setTime(0, 0, 0, 0);

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetTimeMethodCallRector\Fixture;

class Something
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}

$something = new Something();

$something->date()->setTime(new \Aeon\Calendar\Gregorian\Time(0, 0, 0, 0));

?>
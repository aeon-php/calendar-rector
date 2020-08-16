<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetDateMethodCallRector\Fixture;

class Something
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}

$something = new Something();

$something->date()->setDate(0, 0, 0);

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\SetDateMethodCallRector\Fixture;

class Something
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}

$something = new Something();

$something->date()->setDate(\Aeon\Calendar\Gregorian\Day::create(0, 0, 0));

?>
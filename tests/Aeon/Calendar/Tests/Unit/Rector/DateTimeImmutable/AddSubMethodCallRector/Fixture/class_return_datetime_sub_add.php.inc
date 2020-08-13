<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\AddSubMethodCallRector\Fixture;

class Something
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}

$something = new Something();

$something->date()->sub(\DateInterval::createFromDateString('10 minutes'));
$something->date()->add(\DateInterval::createFromDateString('10 minutes'));

$something->date()->sub(new \DateInterval('PT1H'));
$something->date()->add(new \DateInterval('PT1H'));

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\AddSubMethodCallRector\Fixture;

class Something
{
    public function date() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}

$something = new Something();

$something->date()->sub(\Aeon\Calendar\TimeUnit::fromDateInterval(\DateInterval::createFromDateString('10 minutes')));
$something->date()->add(\Aeon\Calendar\TimeUnit::fromDateInterval(\DateInterval::createFromDateString('10 minutes')));

$something->date()->sub(\Aeon\Calendar\TimeUnit::fromDateInterval(new \DateInterval('PT1H')));
$something->date()->add(\Aeon\Calendar\TimeUnit::fromDateInterval(new \DateInterval('PT1H')));

?>
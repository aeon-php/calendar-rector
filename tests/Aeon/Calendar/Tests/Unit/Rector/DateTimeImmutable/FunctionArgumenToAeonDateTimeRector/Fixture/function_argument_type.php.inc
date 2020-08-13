<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

function some_function(\DateTimeImmutable $dateTimeImmutable, int $int, \DateTimeImmutable $dateTimeImmutable2) : void
{
}

function no_argument_function() : \DateTimeImmutable
{
}

function first_argument_function(\DateTimeImmutable $dateTimeImmutable) : void
{
}

\array_reduce(
    [],
    function (?\DateTimeImmutable $deliveryDate) : \DateTimeImmutable {
        return $deliveryDate;
    }
);
?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector\Fixture;

function some_function(\Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable, int $int, \Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable2) : void
{
}

function no_argument_function() : \Aeon\Calendar\Gregorian\DateTime
{
}

function first_argument_function(\Aeon\Calendar\Gregorian\DateTime $dateTimeImmutable) : void
{
}

\array_reduce(
    [],
    function (?\Aeon\Calendar\Gregorian\DateTime $deliveryDate) : \Aeon\Calendar\Gregorian\DateTime {
        return $deliveryDate;
    }
);
?>
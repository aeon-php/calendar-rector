<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ReturnTypeToAeonDateTimeRector\Fixture;

function dateTimeImmutable() : \DateTimeImmutable
{
}

function dateTime() : \DateTime
{
}

function dateTimeInterface() : \DateTimeInterface
{
}

function dateTimeImmutableNullable() : ?\DateTimeImmutable
{
}

function dateTimeNullable() : ?\DateTime
{
}

function dateTimeInterfaceNullable() : ?\DateTimeInterface
{
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ReturnTypeToAeonDateTimeRector\Fixture;

function dateTimeImmutable() : \Aeon\Calendar\Gregorian\DateTime
{
}

function dateTime() : \Aeon\Calendar\Gregorian\DateTime
{
}

function dateTimeInterface() : \Aeon\Calendar\Gregorian\DateTime
{
}

function dateTimeImmutableNullable() : ?\Aeon\Calendar\Gregorian\DateTime
{
}

function dateTimeNullable() : ?\Aeon\Calendar\Gregorian\DateTime
{
}

function dateTimeInterfaceNullable() : ?\Aeon\Calendar\Gregorian\DateTime
{
}

?>
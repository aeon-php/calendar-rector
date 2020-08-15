<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ReturnTypeToAeonDateTimeRector\Fixture;

new class()
{
    public function dateTimeImmutable() : \DateTimeImmutable
    {
    }

    public function dateTime() : \DateTime
    {
    }

    public function dateTimeInterface() : \DateTimeInterface
    {
    }

    public function dateTimeImmutableNullable() : ?\DateTimeImmutable
    {
    }

    public function dateTimeNullable() : ?\DateTime
    {
    }

    public function dateTimeInterfaceNullable() : ?\DateTimeInterface
    {
    }
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ReturnTypeToAeonDateTimeRector\Fixture;

new class()
{
    public function dateTimeImmutable() : \Aeon\Calendar\Gregorian\DateTime
    {
    }

    public function dateTime() : \Aeon\Calendar\Gregorian\DateTime
    {
    }

    public function dateTimeInterface() : \Aeon\Calendar\Gregorian\DateTime
    {
    }

    public function dateTimeImmutableNullable() : ?\Aeon\Calendar\Gregorian\DateTime
    {
    }

    public function dateTimeNullable() : ?\Aeon\Calendar\Gregorian\DateTime
    {
    }

    public function dateTimeInterfaceNullable() : ?\Aeon\Calendar\Gregorian\DateTime
    {
    }
}

?>
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ReturnTypeToAeonDateTimeRector\Fixture;

$var = function() : \DateTimeImmutable
{
};

$var = function() : \DateTime
{
};

$var = function() : \DateTimeInterface
{
};

$var = function() : ?\DateTimeImmutable
{
};

$var = function() : ?\DateTime
{
};

$var = function() : ?\DateTimeInterface
{
};

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ReturnTypeToAeonDateTimeRector\Fixture;

$var = function() : \Aeon\Calendar\Gregorian\DateTime
{
};

$var = function() : \Aeon\Calendar\Gregorian\DateTime
{
};

$var = function() : \Aeon\Calendar\Gregorian\DateTime
{
};

$var = function() : ?\Aeon\Calendar\Gregorian\DateTime
{
};

$var = function() : ?\Aeon\Calendar\Gregorian\DateTime
{
};

$var = function() : ?\Aeon\Calendar\Gregorian\DateTime
{
};

?>
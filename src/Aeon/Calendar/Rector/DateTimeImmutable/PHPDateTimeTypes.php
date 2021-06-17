<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PHPStan\Type\ObjectType;

final class PHPDateTimeTypes
{
    /**
     * @return ObjectType[]
     */
    public static function all() : array
    {
        return [new ObjectType(\DateTimeImmutable::class), new ObjectType(\DateTime::class), new ObjectType(\DateTimeInterface::class)];
    }
}

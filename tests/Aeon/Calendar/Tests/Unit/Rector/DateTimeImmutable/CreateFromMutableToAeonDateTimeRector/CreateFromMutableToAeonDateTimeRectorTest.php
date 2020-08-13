<?php

declare(strict_types=1);

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\CreateFromMutableToAeonDateTimeRector;

use Aeon\Calendar\Rector\DateTimeImmutable\CreateFromMutableToAeonDateTimeRector;
use Rector\Core\Testing\PHPUnit\AbstractRectorTestCase;

final class CreateFromMutableToAeonDateTimeRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(string $file) : void
    {
        $this->doTestFile($file);
    }

    public function provideData() : \Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    protected function getRectorClass() : string
    {
        return CreateFromMutableToAeonDateTimeRector::class;
    }
}

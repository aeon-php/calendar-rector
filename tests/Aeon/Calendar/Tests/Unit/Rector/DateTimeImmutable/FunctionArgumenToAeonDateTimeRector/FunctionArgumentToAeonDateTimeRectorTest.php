<?php declare(strict_types=1);

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector;

use Aeon\Calendar\Rector\DateTimeImmutable\FunctionArgumentToAeonDateTimeRector;
use Rector\Core\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class FunctionArgumentToAeonDateTimeRectorTest  extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $fileInfo): void
    {
        $this->doTestFileInfo($fileInfo);
    }

    public function provideData() : \Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    protected function getRectorClass() : string
    {
        return FunctionArgumentToAeonDateTimeRector::class;
    }
}

<?php declare(strict_types=1);

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ToAeonDateTimeRector;

use Aeon\Calendar\Rector\DateTimeImmutable\ToAeonDateTimeRector;
use Rector\Core\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ToAeonDateTimeRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $fileInfo) : void
    {
        $this->doTestFileInfo($fileInfo);
    }

    public function provideData() : \Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    protected function getRectorClass() : string
    {
        return ToAeonDateTimeRector::class;
    }
}

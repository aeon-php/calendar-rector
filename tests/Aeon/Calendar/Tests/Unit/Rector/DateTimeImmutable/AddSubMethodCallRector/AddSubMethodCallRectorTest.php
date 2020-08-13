<?php declare(strict_types=1);

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\AddSubMethodCallRector;

use Aeon\Calendar\Rector\DateTimeImmutable\AddSubMethodCallRector;
use Rector\Core\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class AddSubMethodCallRectorTest  extends AbstractRectorTestCase
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
        return AddSubMethodCallRector::class;
    }
}

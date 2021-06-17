<?php declare(strict_types=1);

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\ArgumentTypeToAeonDateTimeRector;

use Aeon\Calendar\Rector\DateTimeImmutable\ArgumentTypeToAeonDateTimeRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ArgumentTypeToAeonDateTimeRectorTest extends AbstractRectorTestCase
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

    public function provideConfigFilePath() : string
    {
        return __DIR__ . '/config.php';
    }

    protected function getRectorClass() : string
    {
        return ArgumentTypeToAeonDateTimeRector::class;
    }
}

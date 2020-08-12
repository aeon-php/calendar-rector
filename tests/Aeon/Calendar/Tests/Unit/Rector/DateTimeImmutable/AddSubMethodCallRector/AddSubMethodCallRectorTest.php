<?php declare(strict_types=1);

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\AddSubMethodCallRector;

use Aeon\Calendar\Rector\DateTimeImmutable\AddSubMethodCallRector;
use Rector\Core\Testing\PHPUnit\AbstractRectorTestCase;

final class AddSubMethodCallRectorTest  extends AbstractRectorTestCase
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
        return AddSubMethodCallRector::class;
    }
}

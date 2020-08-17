<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class CreateFromMutableToAeonDateTimeRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [StaticCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node) : ?Node
    {
        if ($this->isObjectTypes($node->class, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class]) && $node->name->toString() === 'createFromMutable') {
            return $this->createStaticCall(DateTime::class, 'fromDateTime', [$node->args[0]]);
        }

        return $node;
    }

    /**
     * From this method documentation is generated.
     */
    public function getDefinition() : RectorDefinition
    {
        return new RectorDefinition(
            'Replace \DateTimeImmutable add/sub method calls with Aeon GregorianCalendar DateTime add/sub',
            [
                new CodeSample(
                    // code before
                    '$dateTime->sub(new \DateInterval(\'PT1H\'));',
                    // code after
                    '$dateTime->sub(\Aeon\Calendar\TimeUnit::fromDateInterval(\DateInterval::createFromDateString(\'10 minutes\')));'
                ),
            ]
        );
    }
}

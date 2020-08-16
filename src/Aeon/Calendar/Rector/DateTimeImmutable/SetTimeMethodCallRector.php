<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\Time;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class SetTimeMethodCallRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node) : ?Node
    {
        if ($node->var instanceof Node\Expr\Variable || $node->var instanceof MethodCall) {
            if ($this->isObjectTypes($node, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
                if (\mb_strtolower($node->name->toString()) === 'settime') {
                    $node->args = [
                        new New_(
                            new FullyQualified(Time::class),
                            $node->args,
                        ),
                    ];

                    return $node;
                }
            }
        }

        return $node;
    }

    /**
     * From this method documentation is generated.
     */
    public function getDefinition() : RectorDefinition
    {
        return new RectorDefinition(
            'Replace \DateTimeImmutable setTime method with Aeon GregorianCalendar Time',
            [
                new CodeSample(
                    // code before
                    '$dateTime->setTime(1, 0, 0, 0)',
                    // code after
                    '$dateTime->setTime(new \Aeon\Calendar\Gregorian\Time(1, 0, 0, 0);'
                ),
            ]
        );
    }
}

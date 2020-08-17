<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\Day;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class SetDateMethodCallRector extends AbstractRector
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
        if ($this->isObjectTypes($node, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
            if (\mb_strtolower($node->name->toString()) === 'setdate') {
                $node->args = [
                    new Node\Expr\StaticCall(
                        new Node\Name\FullyQualified(Day::class),
                        'create',
                        $node->args
                    ),
                ];

                return $node;
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
            'Replace \DateTimeImmutable setDate method with Aeon GregorianCalendar Day',
            [
                new CodeSample(
                    // code before
                    '$dateTime->setDate(1, 0, 0)',
                    // code after
                    '$dateTime->setDate(new \Aeon\Calendar\Gregorian\Day(1, 0, 0));'
                ),
            ]
        );
    }
}

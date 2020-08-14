<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\TimeZone;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class SetTimezoneToAeonDateTimeToTimeZoneRector extends AbstractRector
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
                if (\mb_strtolower($node->name->toString()) === 'settimezone') {
                    $node->name = new Node\Identifier('toTimeZone');
                    $node->args[0] = new Node\Expr\StaticCall(
                        new Node\Name\FullyQualified(TimeZone::class),
                        'fromDateTimeZone',
                        [
                            $node->args[0]->value,
                        ]
                    );

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
            'Replace \DateTimeImmutable add/sub method calls with Aeon GregorianCalendar DateTime add/sub',
            [
                new CodeSample(
                    // code before
                    '$dateTime->setTimezone(new \DateTimezone("UTC"));',
                    // code after
                    '$dateTime->toTimeZone(\Aeon\Calendar\Gregorina\TimeZone::fromDateZone(new \DateTimezone("UTC")));'
                ),
            ]
        );
    }
}

<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use Aeon\Calendar\Gregorian\GregorianCalendar;
use Aeon\Calendar\Gregorian\TimeZone;
use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class DateTimeToAeonDateTimeRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [Node\Expr\New_::class];
    }

    /**
     * @param Node\Expr\New_ $node
     */
    public function refactor(Node $node) : ?Node
    {
        if ($node->class instanceof Node\Stmt\ClassLike) {
            return $node;
        }

        if ($node->class->toString() !== \DateTimeImmutable::class && $node->class->toString() !== \DateTime::class) {
            return null;
        }

        // new \DateTimeImmutable();
        if (!\count($node->args)) {
            $calendarNode = $this->createStaticCall(GregorianCalendar::class, 'systemDefault', []);

            return $this->createMethodCall($calendarNode, 'now', []);
        }

        // new \DateTimeImmutable('now');
        // new \DateTimeImmutable('2020-01-01');
        if (\count($node->args) === 1) {
            if ($node->args[0]->value instanceof Node\Scalar\String_) {
                if (\mb_strtolower($this->getValue($node->args[0]->value)) === 'now') {
                    $calendarNode = $this->createStaticCall(GregorianCalendar::class, 'systemDefault', []);

                    return $this->createMethodCall($calendarNode, 'now', []);
                }

                return $this->createStaticCall(DateTime::class, 'fromString', [$node->args[0]]);
            }
        }

        // new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        // new \DateTimeImmutable('2020-01-01', new \DateTimeZone('UTC'));
        if (\count($node->args) === 2) {
            if ($node->args[0]->value instanceof Node\Scalar\String_ && $node->args[1]->value instanceof Node\Expr\New_) {
                /** @var Node\Expr\New_ $timeZoneArgument */
                $timeZoneArgument = $node->args[1]->value;

                if (\mb_strtolower($this->getValue($node->args[0]->value)) === 'now') {
                    $calendarVariable = new Node\Expr\Variable('calendar');
                    $calendarVariable = new Node\Expr\Assign(
                        $calendarVariable,
                        new Node\Expr\New_(
                            new Node\Name\FullyQualified(GregorianCalendar::class),
                            [
                                new Node\Expr\New_(
                                    new Node\Name\FullyQualified(TimeZone::class),
                                    [
                                        new Node\Scalar\String_($this->getValue($timeZoneArgument->args[0]->value)),
                                    ]
                                ),
                            ]
                        )
                    );

                    $this->addNodeBeforeNode(
                        $calendarVariable,
                        $node
                    );

                    return $this->createMethodCall($calendarVariable->var, 'now', []);
                }

                $dateTimeNode = $this->createStaticCall(DateTime::class, 'fromString', [$node->args[0]]);

                return $this->createMethodCall($dateTimeNode, 'toTimeZone', [
                    new Node\Expr\New_(
                        new Node\Name\FullyQualified(TimeZone::class),
                        [
                            new Node\Scalar\String_($this->getValue($timeZoneArgument->args[0]->value)),
                        ]
                    ),
                ]);
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
            'Replace creating instance \DateTimeImmutable with Aeon DateTime GregorianCalendar DateTime',
            [
                new CodeSample(
                    // code before
                    'new \DateTimeImmutable();',
                    // code after
                    'GregorianCalendar::systemDefault()->now();'
                ),
            ]
        );
    }
}

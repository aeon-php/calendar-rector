<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use Aeon\Calendar\Gregorian\GregorianCalendar;
use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class DateTimeToAeonDateTimeRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [New_::class];
    }

    /**
     * @param New_ $node
     */
    public function refactor(Node $node) : ?Node
    {
        if (!$this->isObjectTypes($node->class, [\DateTimeImmutable::class, \DateTime::class])) {
            return null;
        }

        if ($node->getAttribute(AttributeKey::SCOPE) === null) {
            return null;
        }

        // new \DateTimeImmutable();
        if (!\count($node->args)) {
            $calendarNode = $this->createStaticCall(GregorianCalendar::class, 'systemDefault', []);

            return $this->createMethodCall($calendarNode, 'now', []);
        }

        $dateTimeArg = $node->args[0];

        if (\count($node->args) === 1) {
            if ($this->isStringOrUnionStringOnlyType($dateTimeArg->value)) {
                if (\mb_strtolower($this->getValue($dateTimeArg->value)) === 'now') {
                    $calendarNode = $this->createStaticCall(GregorianCalendar::class, 'systemDefault', []);

                    return $this->createMethodCall($calendarNode, 'now', []);
                }
            }

            return $this->createStaticCall(DateTime::class, 'fromString', $node->args);
        }

        $timezoneArg = $node->args[1];

        if ($this->isStringOrUnionStringOnlyType($dateTimeArg->value)) {
            if (\mb_strtolower($this->getValue($dateTimeArg->value)) === 'now') {
                $calendarNode = new New_(
                    new FullyQualified(GregorianCalendar::class),
                    [
                        $timezoneArg,
                    ]
                );

                return $this->createMethodCall($calendarNode, 'now', []);
            }
        }

        $dateTime = $this->createStaticCall(DateTime::class, 'fromString', [
            $dateTimeArg,
        ]);

        return $this->createMethodCall(
            $dateTime,
            'toTimeZone',
            [
                $timezoneArg,
            ]
        );
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

<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use Aeon\Calendar\Gregorian\GregorianCalendar;
use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

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
        if (!$this->nodeTypeResolver->isObjectTypes($node->class, PHPDateTimeTypes::all())) {
            return null;
        }

        if ($node->getAttribute(AttributeKey::SCOPE) === null) {
            return null;
        }

        // new \DateTimeImmutable();
        if (!\count($node->args)) {
            $calendarNode = $this->nodeFactory->createStaticCall(GregorianCalendar::class, 'systemDefault', []);

            return $this->nodeFactory->createMethodCall($calendarNode, 'now', []);
        }

        $dateTimeArg = $node->args[0];

        if (\count($node->args) === 1) {
            if ($value = $this->valueResolver->getValue($dateTimeArg->value)) {
                if ($value && \mb_strtolower($value) === 'now') {
                    $calendarNode = $this->nodeFactory->createStaticCall(GregorianCalendar::class, 'systemDefault', []);

                    return $this->nodeFactory->createMethodCall($calendarNode, 'now', []);
                }
            }

            return $this->nodeFactory->createStaticCall(DateTime::class, 'fromString', $node->args);
        }

        $timezoneArg = $node->args[1];

        if ($value = $this->valueResolver->getValue($dateTimeArg->value)) {
            if ($value && \mb_strtolower($value) === 'now') {
                $calendarNode = new New_(
                    new FullyQualified(GregorianCalendar::class),
                    [
                        $timezoneArg,
                    ]
                );

                return $this->nodeFactory->createMethodCall($calendarNode, 'now', []);
            }
        }

        $dateTime = $this->nodeFactory->createStaticCall(DateTime::class, 'fromString', [
            $dateTimeArg,
        ]);

        return $this->nodeFactory->createMethodCall(
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
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition(
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

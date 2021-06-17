<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

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
     * @param StaticCall $node
     */
    public function refactor(Node $node) : ?Node
    {
        if ($this->isDateTimeCreateFromMutable($node)) {
            return $this->nodeFactory->createStaticCall(DateTime::class, 'fromDateTime', [$node->args[0]]);
        }

        return $node;
    }

    /**
     * From this method documentation is generated.
     */
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition(
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

    private function isDateTimeCreateFromMutable(StaticCall $node) : bool
    {
        if (\mb_strtolower($node->name->toString()) !== 'createfrommutable') {
            return false;
        }

        if (\count($node->args) !== 1) {
            return false;
        }

        if ($this->nodeTypeResolver->isObjectTypes($node, PHPDateTimeTypes::all())) {
            if (\mb_strtolower($node->name->toString()) === 'createfrommutable') {
                return true;
            }
        }

        foreach ($node->args as $arg) {
            if (!$this->nodeTypeResolver->isObjectType($arg->value, new ObjectType(\DateTime::class))) {
                return false;
            }
        }

        return true;
    }
}

<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\TimeUnit;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class AddSubMethodCallRector extends AbstractRector
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
        if ($this->isDateAddSub($node)) {
            $node->args[0] = new Node\Expr\StaticCall(
                new Node\Name\FullyQualified(TimeUnit::class),
                'fromDateInterval',
                [
                    $node->args[0]->value,
                ]
            );

            return $node;
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

    private function isDateAddSub(MethodCall $node) : bool
    {
        if ($this->nodeTypeResolver->isObjectTypes($node, PHPDateTimeTypes::all())) {
            if (\in_array(\mb_strtolower($node->name->toString()), ['sub', 'add'], true)) {
                return true;
            }
        }

        if (!\in_array(\mb_strtolower($node->name->toString()), ['sub', 'add'], true)) {
            return false;
        }

        if (\count($node->args) !== 1) {
            return false;
        }

        foreach ($node->args as $arg) {
            if (!$this->isObjectType($arg->value, new ObjectType(\DateInterval::class))) {
                return false;
            }
        }

        return true;
    }
}

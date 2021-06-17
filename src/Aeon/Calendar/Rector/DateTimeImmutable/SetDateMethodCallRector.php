<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\Day;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Type\IntegerType;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

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
        if ($node->getAttribute(AttributeKey::SCOPE) === null) {
            return null;
        }

        if ($this->isDateTimeSetDate($node)) {
            $node->args = [
                new StaticCall(
                    new FullyQualified(Day::class),
                    'create',
                    $node->args
                ),
            ];

            $node->name = new Identifier('setDay');

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
            'Replace \DateTimeImmutable setDate method with Aeon GregorianCalendar Day',
            [
                new CodeSample(
                    // code before
                    '$dateTime->setDate(1, 0, 0)',
                    // code after
                    '$dateTime->setDay(new \Aeon\Calendar\Gregorian\Day(1, 0, 0));'
                ),
            ]
        );
    }

    private function isDateTimeSetDate(MethodCall $node) : bool
    {
        if ($this->nodeTypeResolver->isObjectTypes($node, PHPDateTimeTypes::all())) {
            if (\mb_strtolower($node->name->toString()) === 'setdate') {
                return true;
            }
        }

        if (\mb_strtolower($node->name->toString()) !== 'setdate') {
            return false;
        }

        if (\count($node->args) !== 3) {
            return false;
        }

        foreach ($node->args as $arg) {
            if (!$this->nodeTypeResolver->isStaticType($arg->value, IntegerType::class)) {
                return false;
            }
        }

        return true;
    }
}

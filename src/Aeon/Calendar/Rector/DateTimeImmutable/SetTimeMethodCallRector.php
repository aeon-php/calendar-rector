<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\Time;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Type\IntegerType;
use Rector\Core\Php\TypeAnalyzer;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class SetTimeMethodCallRector extends AbstractRector
{
    private TypeAnalyzer $typeAnalyzer;

    public function __construct(TypeAnalyzer $typeAnalyzer)
    {
        $this->typeAnalyzer = $typeAnalyzer;
    }

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
        if ($this->isDateTimeSetTime($node)) {
            $node->args = [
                new New_(
                    new FullyQualified(Time::class),
                    $node->args,
                ),
            ];

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

    private function isDateTimeSetTime(MethodCall $node) : bool
    {
        if ($this->nodeTypeResolver->isObjectTypes($node, PHPDateTimeTypes::all())) {
            if (\mb_strtolower($node->name->toString()) === 'settime') {
                if (\count($node->args) < 2 || \count($node->args) > 4) {
                    return false;
                }

                return true;
            }
        }

        if (\mb_strtolower($node->name->toString()) !== 'settime') {
            return false;
        }

        if (\count($node->args) < 2 || \count($node->args) > 4) {
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

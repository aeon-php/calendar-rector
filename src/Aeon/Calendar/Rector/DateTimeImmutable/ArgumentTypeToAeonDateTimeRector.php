<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use PhpParser\Node;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ArgumentTypeToAeonDateTimeRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [ClassMethod::class, Function_::class, FunctionLike::class];
    }

    /**
     * @param ClassMethod|Function_|FunctionLike $node
     */
    public function refactor(Node $node) : ?Node
    {
        foreach ($node->params as $index => $param) {
            if (!$param->type instanceof Node) {
                continue;
            }

            if ($this->nodeTypeResolver->isObjectTypes($param->type, PHPDateTimeTypes::all())) {
                $param->type = new Node\Name\FullyQualified(DateTime::class);
            }

            if ($param->type instanceof Node\NullableType) {
                if ($this->nodeTypeResolver->isObjectTypes($param->type->type, PHPDateTimeTypes::all())) {
                    $param->type->type = new Node\Name\FullyQualified(DateTime::class);
                }
            }
        }

        return $node;
    }

    /**
     * From this method documentation is generated.
     */
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition(
            'Replace \DateTimeImmutable method argument type to Aeon DateTime GregorianCalendar DateTime type',
            [
                new CodeSample(
                    // code before
                    'SomeClass::method(\DateTimeImmutable $dateTime)',
                    // code after
                    'SomeClass::method(\Aeon\Calendar\Gregorian\DateTime $dateTime)'
                ),
            ]
        );
    }
}

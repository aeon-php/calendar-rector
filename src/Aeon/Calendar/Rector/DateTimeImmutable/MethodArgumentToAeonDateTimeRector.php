<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class MethodArgumentToAeonDateTimeRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [Node\Stmt\ClassMethod::class];
    }

    /**
     * @param Node\Stmt\ClassMethod $node
     */
    public function refactor(Node $node) : ?Node
    {
        foreach ($node->params as $index => $param) {
            if (!$param->type instanceof Node) {
                continue;
            }

            if ($this->isObjectTypes($param->type, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
                $param->type = new Node\Name\FullyQualified(DateTime::class);
            }

            if ($param->type instanceof Node\NullableType) {
                if ($this->isObjectTypes($param->type->type, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
                    $param->type->type = new Node\Name\FullyQualified(DateTime::class);
                }
            }
        }

        if ($node->returnType instanceof Node\Name\FullyQualified) {
            if ($this->isObjectTypes($node->returnType, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
                $node->returnType = new Node\Name\FullyQualified(DateTime::class);
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

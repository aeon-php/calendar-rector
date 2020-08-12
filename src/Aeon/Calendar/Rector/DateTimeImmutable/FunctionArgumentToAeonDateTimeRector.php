<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use PhpParser\Node;
use PhpParser\Node\Stmt\Function_;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class FunctionArgumentToAeonDateTimeRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [Function_::class];
    }

    /**
     * @param Function_ $node
     */
    public function refactor(Node $node) : ?Node
    {
        foreach ($node->params as $index => $param) {
            if ($param->type instanceof Node\Name\FullyQualified) {
                if ($param->type->toString() === \DateTimeImmutable::class) {
                    $param->type = new Node\Name\FullyQualified(DateTime::class);
                }
            }
        }

        if ($node->returnType instanceof Node\Name\FullyQualified) {
            if ($node->returnType->toString() === \DateTimeImmutable::class) {
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
            'Replace \DateTimeImmutable function argument type to Aeon DateTime GregorianCalendar DateTime type',
            [
                new CodeSample(
                    // code before
                    'some_function(\DateTimeImmutable $dateTime)',
                    // code after
                    'some_function(\Aeon\Calendar\Gregorian\DateTime $dateTime)'
                ),
            ]
        );
    }
}

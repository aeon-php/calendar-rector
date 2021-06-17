<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Property;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ClassDateTimePropertyToAeonDateTimeRector  extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [Property::class];
    }

    /**
     * @param Property $node
     */
    public function refactor(Node $node) : ?Node
    {
        if (!$node->type instanceof Node) {
            return $node;
        }

        if ($this->nodeTypeResolver->isObjectTypes($node->type, PHPDateTimeTypes::all())) {
            $node->type = new FullyQualified(DateTime::class);
        }

        return $node;
    }

    /**
     * From this method documentation is generated.
     */
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition(
            'Replace \DateTimeImmutable class properties types with Aeon GregorianCalendar DateTime',
            [
                new CodeSample(
                // code before
                    'private \DateTime $dateTime;',
                    // code after
                    'private \Aeon\Calendar\Gregorina\DateTime $dateTime;'
                ),
            ]
        );
    }
}

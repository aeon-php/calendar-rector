<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\DateTime;
use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Property;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

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
        $type = $node->type;

        if ($type instanceof FullyQualified) {
            if (\in_array($type->toString(), [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class], true)) {
                $node->type = new FullyQualified(DateTime::class);
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
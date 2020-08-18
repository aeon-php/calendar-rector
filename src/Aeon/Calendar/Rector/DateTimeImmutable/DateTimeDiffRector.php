<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PhpParser\Node;
use PhpParser\Node\Expr\PropertyFetch;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class DateTimeDiffRector extends AbstractRector
{
    public function getNodeTypes() : array
    {
        return [PropertyFetch::class];
    }

    /**
     * @param PropertyFetch $node
     */
    public function refactor(Node $node) : ?Node
    {
        if ($node->getAttribute(AttributeKey::SCOPE) === null) {
            return null;
        }

        if ($this->isDateTimeDiffCall($node)) {
            $node->var->name = new Node\Identifier('distanceUntil');

            switch ($node->name->toString()) {
                case 'days':
                    return $this->createMethodCall($node->var, 'inDaysAbs');

                break;

                default:
                    return null;
            }
        }

        return $node;
    }

    public function getDefinition() : RectorDefinition
    {
        return new RectorDefinition(
            '',
            [
                new CodeSample(
                    // code before
                    '',
                    // code after
                    ''
                ),
            ]
        );
    }

    private function isDateTimeDiffCall(PropertyFetch $node) : bool
    {
        if (
            !$this->isOnClassMethodCall($node->var, \DateTimeImmutable::class, 'diff')
            && !$this->isOnClassMethodCall($node->var, \DateTimeInterface::class, 'diff')
            && !$this->isOnClassMethodCall($node->var, \DateTime::class, 'diff')
        ) {
            return false;
        }

        if (!\in_array($node->name->toString(), ['days', 'f', 's', 'i', 'h', 'd', 'm', 'y'], true)) {
            return false;
        }

        return true;
    }
}

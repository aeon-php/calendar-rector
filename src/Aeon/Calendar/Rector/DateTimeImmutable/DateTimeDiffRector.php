<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

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

        if ($this->isDateTimePropertyFetchOnDiffMethodCall($node)) {
            $node->var->name = new Node\Identifier('distanceUntil');

            switch ($node->name->toString()) {
                case 'days':
                    return $this->nodeFactory->createMethodCall($node->var, 'inDaysAbs');

                default:
                    return null;
            }
        }

        return $node;
    }

    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition(
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

    private function isDateTimePropertyFetchOnDiffMethodCall(PropertyFetch $node) : bool
    {
        if ($node->var instanceof MethodCall) {
            if (!$this->nodeTypeResolver->isObjectTypes($node->var->var, PHPDateTimeTypes::all())) {
                return false;
            }

            if (!\in_array(\strtolower($node->name->toString()), ['days', 'f', 's', 'i', 'h', 'd', 'm', 'y'], true)) {
                return false;
            }

            return true;
        }

        return false;
    }
}

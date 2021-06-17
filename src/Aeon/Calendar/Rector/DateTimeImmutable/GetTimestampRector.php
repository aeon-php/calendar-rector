<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class GetTimestampRector extends AbstractRector
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

        if ($this->isDateTimeGetTimestamp($node)) {
            $node->name = new Node\Identifier('timestampUNIX');

            return $this->nodeFactory->createMethodCall($node, 'inSeconds');
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
                    '$dateTime->getTimestamp();',
                    // code after
                    '$dateTime->timestampUNIX()->inSeconds();'
                ),
            ]
        );
    }

    private function isDateTimeGetTimestamp(MethodCall $node) : bool
    {
        if ($this->nodeTypeResolver->isObjectTypes($node, PHPDateTimeTypes::all())) {
            if (\mb_strtolower($node->name->toString()) === 'gettimestamp') {
                return true;
            }
        }

        if (\mb_strtolower($node->name->toString()) !== 'gettimestamp') {
            return false;
        }

        if (\count($node->args) !== 0) {
            return false;
        }

        return true;
    }
}

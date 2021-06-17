<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp;
use PhpParser\Node\Expr\MethodCall;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class DateTimeBinaryOperatorRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [BinaryOp::class];
    }

    /**
     * @param BinaryOp $node
     */
    public function refactor(Node $node) : ?Node
    {
        $left = $node->left;
        $right = $node->right;

        if ($left instanceof MethodCall && $left->name->toString() === 'toDateTimeImmutable') {
            return null;
        }

        if ($right instanceof MethodCall && $right->name->toString() === 'toDateTimeImmutable') {
            return null;
        }

        if ($this->nodeTypeResolver->isObjectTypes($left, PHPDateTimeTypes::all())
            && $this->nodeTypeResolver->isObjectTypes($right, PHPDateTimeTypes::all())
        ) {
            if ($node instanceof BinaryOp\Smaller) {
                return $this->nodeFactory->createMethodCall($left, 'isBefore', [$right]);
            }

            if ($node instanceof BinaryOp\SmallerOrEqual) {
                return $this->nodeFactory->createMethodCall($left, 'isBeforeOrEqual', [$right]);
            }

            if ($node instanceof BinaryOp\Greater) {
                return $this->nodeFactory->createMethodCall($left, 'isAfter', [$right]);
            }

            if ($node instanceof BinaryOp\GreaterOrEqual) {
                return $this->nodeFactory->createMethodCall($left, 'isAfterOrEqual', [$right]);
            }

            if ($node instanceof BinaryOp\Spaceship) {
                $node->left = $this->nodeFactory->createMethodCall($node->left, 'toDateTimeImmutable', []);
                $node->right = $this->nodeFactory->createMethodCall($node->right, 'toDateTimeImmutable', []);

                return $node;
            }

            if ($node instanceof BinaryOp\Equal) {
                return $this->nodeFactory->createMethodCall($left, 'isEqual', [$right]);
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

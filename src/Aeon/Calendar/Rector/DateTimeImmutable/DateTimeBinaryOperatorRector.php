<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp;
use PhpParser\Node\Expr\MethodCall;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

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
            return $node;
        }

        if ($right instanceof MethodCall && $right->name->toString() === 'toDateTimeImmutable') {
            return $node;
        }

        if ($this->isObjectTypes($left, [\DateTime::class, \DateTimeImmutable::class, \DateTimeInterface::class])
            && $this->isObjectTypes($right, [\DateTime::class, \DateTimeImmutable::class, \DateTimeInterface::class])
        ) {
            if ($node instanceof BinaryOp\Smaller) {
                return $this->createMethodCall($left, 'isBefore', [$right]);
            }

            if ($node instanceof BinaryOp\SmallerOrEqual) {
                return $this->createMethodCall($left, 'isBeforeOrEqual', [$right]);
            }

            if ($node instanceof BinaryOp\Greater) {
                return $this->createMethodCall($left, 'isAfter', [$right]);
            }

            if ($node instanceof BinaryOp\GreaterOrEqual) {
                return $this->createMethodCall($left, 'isAfterOrEqual', [$right]);
            }

            if ($node instanceof BinaryOp\Spaceship) {
                $node->left = $this->createMethodCall($node->left, 'toDateTimeImmutable', []);
                $node->right = $this->createMethodCall($node->right, 'toDateTimeImmutable', []);

                return $node;
            }

            return $this->createMethodCall($left, 'isEqual', [$right]);
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

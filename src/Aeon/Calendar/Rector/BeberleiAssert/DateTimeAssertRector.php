<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\BeberleiAssert;

use Assert\Assertion;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class DateTimeAssertRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [StaticCall::class];
    }

    /**
     * @param StaticCall $node
     */
    public function refactor(Node $node) : ?Node
    {
        if ($this->isInObjectType($node->class, Assertion::class)) {
            $arguments = $node->args;

            if (\count($arguments) < 2) {
                return $node;
            }

            if (!$this->isObjectTypes($arguments[0]->value, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
                return $node;
            }

            if (!$this->isObjectTypes($arguments[1]->value, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
                return $node;
            }

            $newArguments = [];

            switch ($node->name->toString()) {
                case 'eq':
                    $newArguments[] = $this->createMethodCall($arguments[0]->value, 'isEqual', [$arguments[1]->value]);

                    break;
                case 'greaterThan':
                    $newArguments[] = $this->createMethodCall($arguments[0]->value, 'isAfter', [$arguments[1]->value]);

                    break;
                case 'greaterOrEqualThan':
                    $newArguments[] = $this->createMethodCall($arguments[0]->value, 'isAfterOrEqual', [$arguments[1]->value]);

                    break;
                case 'lessThan':
                    $newArguments[] = $this->createMethodCall($arguments[0]->value, 'isBefore', [$arguments[1]->value]);

                    break;

                case 'lessThanOrEqualThan':
                    $newArguments[] = $this->createMethodCall($arguments[0]->value, 'isBeforeOrEqual', [$arguments[1]->value]);

                    break;
            }

            if (isset($arguments[2])) {
                $newArguments[] = $arguments[2];
            }

            if (isset($arguments[3])) {
                $newArguments[] = $arguments[3];
            }

            $node->name = new Node\Identifier('true');
            $node->args = $newArguments;

            return $node;
        }

        return $node;
    }

    public function getDefinition() : RectorDefinition
    {
        return new RectorDefinition(
            'Replace datetime assertion with Assert::true',
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
}

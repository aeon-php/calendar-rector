<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\BeberleiAssert;

use Aeon\Calendar\Gregorian\Calendar;
use Aeon\Calendar\Rector\DateTimeImmutable\PHPDateTimeTypes;
use Assert\Assertion;
use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

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
        if ($this->nodeTypeResolver->isObjectType($node->class, new ObjectType(Assertion::class))) {
            $arguments = $node->args;

            if (\count($arguments) < 2) {
                return null;
            }

            if (!$this->areComparableDateTimes($arguments[0]->value, $arguments[1]->value)) {
                return null;
            }

            $newArguments = [];

            switch ($node->name->toString()) {
                case 'eq':
                    $newArguments[] = $this->nodeFactory->createMethodCall($arguments[0]->value, 'isEqual', [$arguments[1]->value]);

                    break;
                case 'greaterThan':
                    $newArguments[] = $this->nodeFactory->createMethodCall($arguments[0]->value, 'isAfter', [$arguments[1]->value]);

                    break;
                case 'greaterOrEqualThan':
                    $newArguments[] = $this->nodeFactory->createMethodCall($arguments[0]->value, 'isAfterOrEqual', [$arguments[1]->value]);

                    break;
                case 'lessThan':
                    $newArguments[] = $this->nodeFactory->createMethodCall($arguments[0]->value, 'isBefore', [$arguments[1]->value]);

                    break;

                case 'lessThanOrEqualThan':
                    $newArguments[] = $this->nodeFactory->createMethodCall($arguments[0]->value, 'isBeforeOrEqual', [$arguments[1]->value]);

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

    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition(
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

    private function areComparableDateTimes(Node\Expr $valueArgument, Node\Expr $expectationArgument) : bool
    {
        if ($valueArgument instanceof ClassConstFetch || $expectationArgument instanceof ClassConstFetch) {
            return false;
        }

        if ($valueArgument instanceof Node\Expr\MethodCall) {
            if (!$this->isObjectType($valueArgument->var, new ObjectType(Calendar::class))) {
                return false;
            }
        } elseif (!$this->nodeTypeResolver->isObjectTypes($valueArgument, PHPDateTimeTypes::all())) {
            return false;
        }

        if ($expectationArgument instanceof Node\Expr\MethodCall) {
            if (!$this->isObjectType($expectationArgument->var, new ObjectType(Calendar::class))) {
                return false;
            }
        } elseif (!$this->nodeTypeResolver->isObjectTypes($expectationArgument, PHPDateTimeTypes::all())) {
            return false;
        }

        return true;
    }
}

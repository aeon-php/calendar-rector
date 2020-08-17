<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\TimeUnit;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

final class AddSubMethodCallRector extends AbstractRector
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
        if ($this->isDateAddSub($node)) {
            $node->args[0] = new Node\Expr\StaticCall(
                new Node\Name\FullyQualified(TimeUnit::class),
                'fromDateInterval',
                [
                    $node->args[0]->value,
                ]
            );

            return $node;
        }

        return $node;
    }

    /**
     * From this method documentation is generated.
     */
    public function getDefinition() : RectorDefinition
    {
        return new RectorDefinition(
            'Replace \DateTimeImmutable add/sub method calls with Aeon GregorianCalendar DateTime add/sub',
            [
                new CodeSample(
                    // code before
                    '$dateTime->sub(new \DateInterval(\'PT1H\'));',
                    // code after
                    '$dateTime->sub(\Aeon\Calendar\TimeUnit::fromDateInterval(\DateInterval::createFromDateString(\'10 minutes\')));'
                ),
            ]
        );
    }

    private function isDateAddSub(MethodCall $node) : bool
    {
        if ($this->isObjectTypes($node, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
            if (\in_array(\mb_strtolower($node->name->toString()), ['sub', 'add'], true)) {
                return true;
            }
        }

        if (!\in_array(\mb_strtolower($node->name->toString()), ['sub', 'add'], true)) {
            return false;
        }

        if (\count($node->args) !== 1) {
            return false;
        }

        foreach ($node->args as $arg) {
            if (!$this->isObjectType($arg->value, \DateInterval::class)) {
                return false;
            }
        }

        return true;
    }
}

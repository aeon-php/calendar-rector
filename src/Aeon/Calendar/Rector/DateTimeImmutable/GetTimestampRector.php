<?php

declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class GetTimestampRector extends AbstractRector
{
    private static int $i = 0;

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
        if ($this->isObjectTypes($node->var, [\DateTimeImmutable::class, \DateTime::class, \DateTimeInterface::class])) {
            if (\mb_strtolower($node->name->toString()) === 'gettimestamp') {
                if ($node->getAttribute(AttributeKey::SCOPE) === null) {
                    return null;
                }

                return $this->createMethodCall($node, 'inSeconds');
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
            'Replace \DateTimeImmutable add/sub method calls with Aeon GregorianCalendar DateTime add/sub',
            [
                new CodeSample(
                // code before
                    '$dateTime->getTimestamp();',
                    // code after
                    '$dateTime->getTimestamp()->inseconds();'
                ),
            ]
        );
    }
}

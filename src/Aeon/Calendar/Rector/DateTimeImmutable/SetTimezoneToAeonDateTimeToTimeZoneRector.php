<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class SetTimezoneToAeonDateTimeToTimeZoneRector extends AbstractRector
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
        if ($this->isDateTimeSetTimeZone($node)) {
            $node->name = new Node\Identifier('toTimeZone');

            return $node;
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
                    '$dateTime->setTimezone(new \DateTimezone("UTC"));',
                    // code after
                    '$dateTime->toTimeZone(\Aeon\Calendar\Gregorina\TimeZone::fromDateZone(new \DateTimezone("UTC")));'
                ),
            ]
        );
    }

    private function isDateTimeSetTimeZone(MethodCall $node) : bool
    {
        if ($this->nodeTypeResolver->isObjectTypes($node, PHPDateTimeTypes::all())) {
            if (\mb_strtolower($node->name->toString()) === 'settimezone') {
                return true;
            }
        }

        if (\mb_strtolower($node->name->toString()) !== 'settimezone') {
            return false;
        }

        if (\count($node->args) !== 1) {
            return false;
        }

        foreach ($node->args as $arg) {
            if (!$this->isObjectType($arg->value, new ObjectType(\DateTimeZone::class))) {
                return false;
            }
        }

        return true;
    }
}

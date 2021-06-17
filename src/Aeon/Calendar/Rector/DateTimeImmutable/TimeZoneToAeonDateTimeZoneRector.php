<?php declare(strict_types=1);

namespace Aeon\Calendar\Rector\DateTimeImmutable;

use Aeon\Calendar\Gregorian\TimeZone;
use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class TimeZoneToAeonDateTimeZoneRector extends AbstractRector
{
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [New_::class];
    }

    /**
     * @param New_ $node
     */
    public function refactor(Node $node) : ?Node
    {
        if (!$this->nodeTypeResolver->isObjectType($node->class, new ObjectType(\DateTimeZone::class))) {
            return $node;
        }

        if ($node->getAttribute(AttributeKey::SCOPE) === null) {
            return null;
        }

        return new New_(
            new FullyQualified(TimeZone::class),
            $node->args
        );
    }

    /**
     * From this method documentation is generated.
     */
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition(
            'Replace creating instance \DateTimeImmutable with Aeon DateTime GregorianCalendar DateTime',
            [
                new CodeSample(
                    // code before
                    'new \DateTimeZone(\'UTC\');',
                    // code after
                    'new \Aeon\Calendar\Gregorian\TimeZone(\'UTC\');'
                ),
            ]
        );
    }
}

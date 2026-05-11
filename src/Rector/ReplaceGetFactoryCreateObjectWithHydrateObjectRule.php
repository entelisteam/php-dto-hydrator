<?php

declare(strict_types=1);

namespace EntelisTeam\DTOHydrator\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Заменяет class::getFactory()->createObject() на class::hydrateObject().
 *
 * Матчит и старое getFactory(), и новое getHydrator() — порядок применения
 * Rector-правил при этом не важен.
 */
final class ReplaceGetFactoryCreateObjectWithHydrateObjectRule extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace class::getFactory()->createObject() with class::hydrateObject()',
            [
                new CodeSample(
                    'SomeClass::getFactory()->createObject($data)',
                    'SomeClass::hydrateObject($data)'
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node->name, 'createObject')) {
            return null;
        }

        if (!$node->var instanceof StaticCall) {
            return null;
        }

        $getFactoryCall = $node->var;

        if (!$this->isName($getFactoryCall->name, 'getFactory') && !$this->isName($getFactoryCall->name, 'getHydrator')) {
            return null;
        }

        return new StaticCall(
            $getFactoryCall->class,
            new Identifier('hydrateObject'),
            $node->args
        );
    }
}

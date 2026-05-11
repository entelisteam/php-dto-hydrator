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
 * Заменяет class::getFactory()->createArray() на class::hydrateArray().
 *
 * Матчит и старое getFactory(), и новое getHydrator() — порядок применения
 * Rector-правил при этом не важен.
 */
final class ReplaceGetFactoryCreateArrayWithHydrateArrayRule extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace class::getFactory()->createArray() with class::hydrateArray()',
            [
                new CodeSample(
                    'SomeClass::getFactory()->createArray($data)',
                    'SomeClass::hydrateArray($data)'
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
        if (!$this->isName($node->name, 'createArray')) {
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
            new Identifier('hydrateArray'),
            $node->args
        );
    }
}

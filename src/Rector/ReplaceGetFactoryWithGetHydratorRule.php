<?php

declare(strict_types=1);

namespace EntelisTeam\DTOHydrator\Rector;

use EntelisTeam\DTOHydrator\Rector\Internal\HydratorTraitDetector;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PHPStan\Reflection\ReflectionProvider;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Заменяет ::getFactory() на ::getHydrator() для классов экосистемы гидратора:
 *  - DTO, использующих HydratorTrait (раньше DTOFactoryTrait);
 *  - HydratorRegistry (раньше DTOFactoryCache).
 *
 * Чужие классы с методом getFactory() не трогаются.
 */
final class ReplaceGetFactoryWithGetHydratorRule extends AbstractRector
{
    public function __construct(private readonly ReflectionProvider $reflectionProvider)
    {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace class::getFactory() with class::getHydrator() on HydratorTrait users and HydratorRegistry',
            [
                new CodeSample(
                    'SomeDTO::getFactory()',
                    'SomeDTO::getHydrator()'
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [StaticCall::class];
    }

    /**
     * @param StaticCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node->name, 'getFactory')) {
            return null;
        }

        $classReflection = HydratorTraitDetector::resolveStaticCallClass(
            $node,
            $this->reflectionProvider,
            $this->nodeNameResolver,
            $this->nodeTypeResolver,
        );
        if (!HydratorTraitDetector::usesHydratorTrait($classReflection)
            && !HydratorTraitDetector::isHydratorRegistry($classReflection)
        ) {
            return null;
        }

        $node->name = new Identifier('getHydrator');
        return $node;
    }
}

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
 * Заменяет class::fromObject($data) на class::hydrateObject($data) для классов,
 * использующих HydratorTrait (раньше DTOFactoryTrait).
 *
 * Метод fromObject() удалён из HydratorTrait/HydratorTraitInterface в пользу
 * hydrateObject(). Чужие классы с методом fromObject() не трогаются.
 */
final class ReplaceFromObjectWithHydrateObjectRule extends AbstractRector
{
    public function __construct(private readonly ReflectionProvider $reflectionProvider)
    {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace class::fromObject() with class::hydrateObject() on HydratorTrait users',
            [
                new CodeSample(
                    'SomeDTO::fromObject($data)',
                    'SomeDTO::hydrateObject($data)'
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
        if (!$this->isName($node->name, 'fromObject')) {
            return null;
        }

        $classReflection = HydratorTraitDetector::resolveStaticCallClass(
            $node,
            $this->reflectionProvider,
            $this->nodeNameResolver,
            $this->nodeTypeResolver,
        );
        if (!HydratorTraitDetector::usesHydratorTrait($classReflection)) {
            return null;
        }

        $node->name = new Identifier('hydrateObject');
        return $node;
    }
}

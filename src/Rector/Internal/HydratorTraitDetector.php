<?php

declare(strict_types=1);

namespace EntelisTeam\DTOHydrator\Rector\Internal;

use EntelisTeam\DTOHydrator\HydratorRegistry;
use EntelisTeam\DTOHydrator\HydratorTrait;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ReflectionProvider;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\StaticTypeMapper\Resolver\ClassNameFromObjectTypeResolver;

/**
 * Проверяет принадлежность класса к экосистеме гидратора (HydratorTrait / HydratorRegistry)
 * — общая логика для миграционных Rector-правил.
 */
final class HydratorTraitDetector
{
    private const TRAIT_FQNS = [
        HydratorTrait::class,
    ];

    private const REGISTRY_FQNS = [
        HydratorRegistry::class,
    ];

    /**
     * Резолвит ClassReflection для статического вызова Class::method() / $var::method().
     * Для Name-узла идём через ReflectionProvider напрямую (Rector-вский
     * resolveClassReflectionSourceObject для Name возвращает null из-за того,
     * как PHPStan типизирует чистый Name).
     */
    public static function resolveStaticCallClass(
        StaticCall $call,
        ReflectionProvider $reflectionProvider,
        NodeNameResolver $nodeNameResolver,
        NodeTypeResolver $nodeTypeResolver,
    ): ?ClassReflection {
        if ($call->class instanceof Node\Name) {
            $fqn = $nodeNameResolver->getName($call->class);
            if ($fqn === null || !$reflectionProvider->hasClass($fqn)) {
                return null;
            }
            return $reflectionProvider->getClass($fqn);
        }

        $objectType = $nodeTypeResolver->getType($call->class);
        $className = ClassNameFromObjectTypeResolver::resolve($objectType);
        if ($className === null || !$reflectionProvider->hasClass($className)) {
            return null;
        }
        return $reflectionProvider->getClass($className);
    }

    public static function usesHydratorTrait(?ClassReflection $classReflection): bool
    {
        if ($classReflection === null) {
            return false;
        }

        $current = $classReflection;
        while ($current !== null) {
            foreach (self::TRAIT_FQNS as $traitFqn) {
                if ($current->hasTraitUse($traitFqn)) {
                    return true;
                }
            }
            $current = $current->getParentClass();
        }

        return false;
    }

    public static function isHydratorRegistry(?ClassReflection $classReflection): bool
    {
        if ($classReflection === null) {
            return false;
        }

        return in_array($classReflection->getName(), self::REGISTRY_FQNS, true);
    }
}

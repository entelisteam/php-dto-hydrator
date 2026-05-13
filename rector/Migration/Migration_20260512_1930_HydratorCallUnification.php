<?php

declare(strict_types=1);

namespace EntelisTeam\Lbaf\Hydrator\Rector\Migration;

use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Rule\ReplaceFromObjectWithHydrateObjectRule;
use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Rule\ReplaceGetFactoryCreateArrayWithHydrateArrayRule;
use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Rule\ReplaceGetFactoryCreateObjectWithHydrateObjectRule;
use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Rule\ReplaceGetFactoryWithGetHydratorRule;
use Rector\Configuration\RectorConfigBuilder;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;

/**
 * Миграция: entelisteam/php-hydrator (namespace EntelisTeam\Hydrator)
 *         → entelisteam/php-dto-hydrator (namespace EntelisTeam\DTOHydrator).
 *
 * Покрывает:
 *  - переименования классов (RenameClassRector);
 *  - переименования методов Hydrator::createObject/createArray → hydrateObject/hydrateArray;
 *  - схлопывание цепочек getFactory()->createObject/createArray() → hydrateObject/hydrateArray();
 *  - переименование одиночного getFactory() → getHydrator() (только на классах гидратора);
 *  - удалённый метод fromObject() → hydrateObject() (только на классах гидратора).
 */
final class Migration_20260512_1930_HydratorCallUnification
{
    public static function apply(RectorConfigBuilder $config): RectorConfigBuilder
    {
        return $config
            ->withRules([
                ReplaceGetFactoryCreateObjectWithHydrateObjectRule::class,
                ReplaceGetFactoryCreateArrayWithHydrateArrayRule::class,
                ReplaceGetFactoryWithGetHydratorRule::class,
                ReplaceFromObjectWithHydrateObjectRule::class,
            ])
            ->withConfiguredRule(RenameMethodRector::class,[
                new MethodCallRename('EntelisTeam\\Lbaf\\Hydrator\\HydratorRegistry', 'getFactory', 'getHydrator'),
                new MethodCallRename('EntelisTeam\\Lbaf\\Hydrator\\Hydrator', 'createObject', 'hydrateObject'),
                new MethodCallRename('EntelisTeam\\Lbaf\\Hydrator\\Hydrator', 'createArray', 'hydrateArray'),
            ])
            ->withImportNames(importNames: true, importDocBlockNames: true, importShortClasses: false, removeUnusedImports: true);
    }
}

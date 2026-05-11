<?php

declare(strict_types=1);

namespace EntelisTeam\DTOHydrator\Rector\Migration;

use EntelisTeam\DTOHydrator\Hydrator;
use EntelisTeam\DTOHydrator\Rector\Migration\Rule\ReplaceFromObjectWithHydrateObjectRule;
use EntelisTeam\DTOHydrator\Rector\Migration\Rule\ReplaceGetFactoryCreateArrayWithHydrateArrayRule;
use EntelisTeam\DTOHydrator\Rector\Migration\Rule\ReplaceGetFactoryCreateObjectWithHydrateObjectRule;
use EntelisTeam\DTOHydrator\Rector\Migration\Rule\ReplaceGetFactoryWithGetHydratorRule;
use Rector\Configuration\RectorConfigBuilder;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
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
 *
 * Подключается автоматически через Composer extra.lbaf-rector-migrations
 * провайдером EntelisTeam\DTOHydrator\Rector\Migrations.
 */
final class M20260511_1500_DTOFactoryToHydrator
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
                new MethodCallRename('EntelisTeam\\DTOHydrator\\HydratorRegistry', 'getFactory', 'getHydrator'),
                new MethodCallRename('EntelisTeam\\DTOHydrator\\Hydrator', 'createObject', 'hydrateObject'),
                new MethodCallRename('EntelisTeam\\DTOHydrator\\Hydrator', 'createArray', 'hydrateArray'),
            ])
            ->withImportNames(importNames: true, importDocBlockNames: true, importShortClasses: false, removeUnusedImports: true);
    }
}

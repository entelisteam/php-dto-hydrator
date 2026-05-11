<?php

declare(strict_types=1);

namespace EntelisTeam\DTOHydrator\Rector\Migration;

use EntelisTeam\DTOHydrator\Hydrator;
use EntelisTeam\DTOHydrator\Rector\ReplaceFromObjectWithHydrateObjectRule;
use EntelisTeam\DTOHydrator\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule;
use EntelisTeam\DTOHydrator\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule;
use EntelisTeam\DTOHydrator\Rector\ReplaceGetFactoryWithGetHydratorRule;
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
    public const CLASS_RENAMES = [
        // Публичный API: DTOFactory* → Hydrator*
        'EntelisTeam\\Hydrator\\DTOFactory' => 'EntelisTeam\\DTOHydrator\\Hydrator',
        'EntelisTeam\\Hydrator\\DTOFactoryCache' => 'EntelisTeam\\DTOHydrator\\HydratorRegistry',
        'EntelisTeam\\Hydrator\\DTOFactoryTrait' => 'EntelisTeam\\DTOHydrator\\HydratorTrait',
        'EntelisTeam\\Hydrator\\DTOFactoryTraitInterface' => 'EntelisTeam\\DTOHydrator\\HydratorTraitInterface',

        // Бывший движок Hydrator → публичный фасад Hydrator (его статический
        // hydrateValue делегирует в Internal\HydratorEngine)
        'EntelisTeam\\Hydrator\\Hydrator' => 'EntelisTeam\\DTOHydrator\\Hydrator',

        // Подпакеты: только смена корня namespace
        'EntelisTeam\\Hydrator\\Attribute\\ArrayTypeOf' => 'EntelisTeam\\DTOHydrator\\Attribute\\ArrayTypeOf',
        'EntelisTeam\\Hydrator\\Definition\\ArgDefinition' => 'EntelisTeam\\DTOHydrator\\Definition\\ArgDefinition',
        'EntelisTeam\\Hydrator\\Definition\\ClassDefinition' => 'EntelisTeam\\DTOHydrator\\Definition\\ClassDefinition',
        'EntelisTeam\\Hydrator\\Definition\\DefinitionType' => 'EntelisTeam\\DTOHydrator\\Definition\\DefinitionType',
        'EntelisTeam\\Hydrator\\Exception\\ArgumentTypeException' => 'EntelisTeam\\DTOHydrator\\Exception\\ArgumentTypeException',
        'EntelisTeam\\Hydrator\\Exception\\HydrationException' => 'EntelisTeam\\DTOHydrator\\Exception\\HydrationException',
        'EntelisTeam\\Hydrator\\Exception\\RequiredArgumentException' => 'EntelisTeam\\DTOHydrator\\Exception\\RequiredArgumentException',
    ];

    /**
     * Переименования методов на классе Hydrator (createObject/createArray → hydrateObject/hydrateArray).
     */
    private static function getMethodRenames(): array
    {
        return [
            new MethodCallRename(Hydrator::class, 'createObject', 'hydrateObject'),
            new MethodCallRename(Hydrator::class, 'createArray', 'hydrateArray'),
        ];
    }

    public static function apply(RectorConfigBuilder $config): RectorConfigBuilder
    {
        return $config
            ->withConfiguredRule(RenameClassRector::class, self::CLASS_RENAMES)
            ->withConfiguredRule(RenameMethodRector::class, self::getMethodRenames())
            ->withRules([
                ReplaceGetFactoryCreateObjectWithHydrateObjectRule::class,
                ReplaceGetFactoryCreateArrayWithHydrateArrayRule::class,
                ReplaceGetFactoryWithGetHydratorRule::class,
                ReplaceFromObjectWithHydrateObjectRule::class,
            ])
            ->withImportNames(importNames: true, importDocBlockNames: true, importShortClasses: false, removeUnusedImports: true);
    }
}

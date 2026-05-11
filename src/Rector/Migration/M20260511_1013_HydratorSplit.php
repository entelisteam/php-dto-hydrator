<?php

declare(strict_types=1);

namespace EntelisTeam\DTOHydrator\Rector\Migration;

use Rector\Configuration\RectorConfigBuilder;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\Rector\StaticCall\RenameStaticMethodRector;
use Rector\Renaming\ValueObject\RenameStaticMethod;

/**
 * Миграция для downstream-проектов: переход с Lbaf-овских namespace'ов на
 * entelisteam/php-reflection-helpers, entelisteam/php-hydrator и Lbaf\Container\InjectionResolver.
 *
 * Использование в rector.php downstream-проекта:
 *
 *   use Lbaf\Rector\Migration\M20260511_1012_HydratorAndContainerSplit;
 *   use Rector\Config\RectorConfig;
 *
 *   return M20260511_1012_HydratorAndContainerSplit::apply(
 *       RectorConfig::configure()->withPaths([__DIR__ . '/src'])
 *   );
 *
 * Покрывает переименования классов и статических методов. Use-импорты и FQN
 * обновляются автоматически встроенными RenameClassRector и RenameStaticMethodRector.
 */
final class M20260511_1013_HydratorSplit
{
    /**
     * Карта переименований классов: old FQN → new FQN.
     */
    public const CLASS_RENAMES = [
        // Hydrator core
        'Lbaf\\Reflection\\ReflectionClassCreator' => 'EntelisTeam\\Hydrator\\Hydrator',

        // Hydrator definitions
        'Lbaf\\Reflection\\Definition\\ClassDefinition' => 'EntelisTeam\\Hydrator\\Definition\\ClassDefinition',
        'Lbaf\\Reflection\\Definition\\ArgDefinition' => 'EntelisTeam\\Hydrator\\Definition\\ArgDefinition',
        'Lbaf\\Reflection\\Definition\\DefinitionType' => 'EntelisTeam\\Hydrator\\Definition\\DefinitionType',

        // Hydrator public facade
        'Lbaf\\Factory\\DTOFactory' => 'EntelisTeam\\Hydrator\\DTOFactory',
        'Lbaf\\Factory\\DTOFactoryCache' => 'EntelisTeam\\Hydrator\\DTOFactoryCache',
        'Lbaf\\Factory\\DTOFactoryTrait' => 'EntelisTeam\\Hydrator\\DTOFactoryTrait',
        'Lbaf\\Factory\\DTOFactoryTraitInterface' => 'EntelisTeam\\Hydrator\\DTOFactoryTraitInterface',

        // Hydrator attribute
        'Lbaf\\Factory\\Attribute\\ArrayTypeOf' => 'EntelisTeam\\Hydrator\\Attribute\\ArrayTypeOf',

    ];

    /**
     * @return RenameStaticMethod[]
     */
    public static function getStaticMethodRenames(): array
    {
        return [
             // Hydrator value coercion
            new RenameStaticMethod('Lbaf\\Reflection\\ReflectionHelper', '_changeInjectValueType', 'EntelisTeam\\Hydrator\\Hydrator', 'hydrateValue'),
        ];
    }

    /**
     * Применяет правила миграции к существующему конфигуратору.
     */
    public static function apply(RectorConfigBuilder $config): RectorConfigBuilder
    {
        return $config
            ->withConfiguredRule(RenameClassRector::class, self::CLASS_RENAMES)
            ->withConfiguredRule(RenameStaticMethodRector::class, self::getStaticMethodRenames())
            //импортируем короткие имена через use вместо FQN, удаляем устаревшие use на Lbaf-овские классы
            ->withImportNames(importNames: true, importDocBlockNames: true, importShortClasses: false, removeUnusedImports: true);
    }
}

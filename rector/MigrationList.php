<?php

declare(strict_types=1);

namespace EntelisTeam\Lbaf\Hydrator\Rector;

use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Migration_20260511_1013_HydratorSplit;
use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Migration_20260512_1845_NamespaceUnification;
use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Migration_20260512_1930_HydratorCallUnification;
use EntelisTeam\Lbaf\Rector\RectorMigrationListInterface;

/**
 * Реестр Rector-миграций пакета entelisteam/php-dto-hydrator.
 */
final class MigrationList implements RectorMigrationListInterface
{
    /**
     * @return list<class-string>
     */
    public static function all(): array
    {
        return [
            Migration_20260511_1013_HydratorSplit::class,
            Migration_20260512_1845_NamespaceUnification::class,
            Migration_20260512_1930_HydratorCallUnification::class,
        ];
    }
}

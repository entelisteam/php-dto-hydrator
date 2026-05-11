<?php

declare(strict_types=1);

use EntelisTeam\DTOHydrator\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withRules([
        ReplaceGetFactoryCreateArrayWithHydrateArrayRule::class,
    ]);

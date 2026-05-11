<?php

declare(strict_types=1);

use EntelisTeam\DTOHydrator\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withRules([
        ReplaceGetFactoryCreateObjectWithHydrateObjectRule::class,
    ]);

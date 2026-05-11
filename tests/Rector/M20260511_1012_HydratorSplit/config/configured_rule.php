<?php

declare(strict_types=1);

use EntelisTeam\DTOHydrator\Rector\Migration\M20260511_1013_HydratorSplit;
use Rector\Config\RectorConfig;

return M20260511_1013_HydratorSplit::apply(RectorConfig::configure());

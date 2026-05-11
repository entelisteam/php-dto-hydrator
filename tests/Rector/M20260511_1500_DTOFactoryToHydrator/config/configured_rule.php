<?php

declare(strict_types=1);

use EntelisTeam\DTOHydrator\Rector\Migration\M20260511_1500_DTOFactoryToHydrator;
use Rector\Config\RectorConfig;

return M20260511_1500_DTOFactoryToHydrator::apply(RectorConfig::configure());

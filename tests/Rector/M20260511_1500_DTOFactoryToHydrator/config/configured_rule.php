<?php

declare(strict_types=1);

use EntelisTeam\Lbaf\Hydrator\Rector\Migration\Migration_20260512_1930_HydratorCallUnification;
use Rector\Config\RectorConfig;

return Migration_20260512_1930_HydratorCallUnification::apply(RectorConfig::configure());

<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use Lbaf\Reflection\ReflectionHelper;

class UsesReflectionHelper
{
    public function run(\ReflectionMethod $method, mixed $value)
    {
        $hydrated = ReflectionHelper::_changeInjectValueType($param, $value);
    }
}

?>
-----
<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use EntelisTeam\Hydrator\Hydrator;

class UsesReflectionHelper
{
    public function run(\ReflectionMethod $method, mixed $value)
    {
        $hydrated = Hydrator::hydrateValue($param, $value);
    }
}

?>

<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\Hydrator\Hydrator;
use ReflectionParameter;

class UsesEngineDirectly
{
    public function coerce(ReflectionParameter $reflection, mixed $value): mixed
    {
        return Hydrator::hydrateValue($reflection, $value, 'mixed');
    }
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Hydrator;
use ReflectionParameter;

class UsesEngineDirectly
{
    public function coerce(ReflectionParameter $reflection, mixed $value): mixed
    {
        return Hydrator::hydrateValue($reflection, $value, 'mixed');
    }
}

?>

<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\Hydrator\DTOFactory;
use EntelisTeam\Hydrator\DTOFactoryCache;
use EntelisTeam\Hydrator\DTOFactoryTrait;
use EntelisTeam\Hydrator\DTOFactoryTraitInterface;

class UsesDtoFactory
{
    public function build(): void
    {
        $factory = new DTOFactory(self::class);
        $factory = DTOFactoryCache::getFactory(self::class);
    }
}

class UsesDtoFactoryTrait implements DTOFactoryTraitInterface
{
    use DTOFactoryTrait;
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Hydrator;
use EntelisTeam\DTOHydrator\HydratorRegistry;
use EntelisTeam\DTOHydrator\HydratorTraitInterface;
use EntelisTeam\DTOHydrator\HydratorTrait;

class UsesDtoFactory
{
    public function build(): void
    {
        $factory = new Hydrator(self::class);
        $factory = HydratorRegistry::getHydrator(self::class);
    }
}

class UsesDtoFactoryTrait implements HydratorTraitInterface
{
    use HydratorTrait;
}

?>

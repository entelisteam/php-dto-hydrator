<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryCache;
use Lbaf\Factory\DTOFactoryTrait;
use Lbaf\Factory\DTOFactoryTraitInterface;

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

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use EntelisTeam\Hydrator\DTOFactory;
use EntelisTeam\Hydrator\DTOFactoryCache;
use EntelisTeam\Hydrator\DTOFactoryTraitInterface;
use EntelisTeam\Hydrator\DTOFactoryTrait;

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

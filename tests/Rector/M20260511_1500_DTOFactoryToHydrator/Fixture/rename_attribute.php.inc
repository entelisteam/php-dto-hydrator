<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\Hydrator\Attribute\ArrayTypeOf;

class UsesArrayTypeOf
{
    public function __construct(
        #[ArrayTypeOf('items', UsesArrayTypeOf::class)]
        public readonly array $items = [],
    ) {}
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Attribute\ArrayTypeOf;

class UsesArrayTypeOf
{
    public function __construct(
        #[ArrayTypeOf('items', UsesArrayTypeOf::class)]
        public readonly array $items = [],
    ) {}
}

?>

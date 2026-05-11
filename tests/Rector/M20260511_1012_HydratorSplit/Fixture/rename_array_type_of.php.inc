<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use Lbaf\Factory\Attribute\ArrayTypeOf;

class UsesArrayTypeOf
{
    public function __construct(
        #[ArrayTypeOf('string')]
        public array $tags,
    ) {
    }
}

?>
-----
<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use EntelisTeam\Hydrator\Attribute\ArrayTypeOf;

class UsesArrayTypeOf
{
    public function __construct(
        #[ArrayTypeOf('string')]
        public array $tags,
    ) {
    }
}

?>

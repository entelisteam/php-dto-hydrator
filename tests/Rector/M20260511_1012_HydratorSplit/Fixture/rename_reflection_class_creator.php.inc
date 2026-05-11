<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use Lbaf\Reflection\ReflectionClassCreator;

class UsesReflectionClassCreator
{
    public function build(string $class, object $data): object
    {
        return ReflectionClassCreator::createClassFromData($class, $data, false);
    }
}

?>
-----
<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use EntelisTeam\Hydrator\Hydrator;

class UsesReflectionClassCreator
{
    public function build(string $class, object $data): object
    {
        return Hydrator::createClassFromData($class, $data, false);
    }
}

?>

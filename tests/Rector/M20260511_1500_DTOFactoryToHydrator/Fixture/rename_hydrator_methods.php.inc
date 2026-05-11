<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Hydrator;

class UsesHydratorMethods
{
    public function build(): void
    {
        //прямой вызов методов на экземпляре фабрики — RenameClassRector делает
        //$factory типизированным как Hydrator, после чего RenameMethodRector
        //переименовывает createObject/createArray.
        $factory = new Hydrator(self::class);
        $object = $factory->createObject(['x' => 1]);
        $list = $factory->createArray([['x' => 1]]);
    }
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Hydrator;

class UsesHydratorMethods
{
    public function build(): void
    {
        //прямой вызов методов на экземпляре фабрики — RenameClassRector делает
        //$factory типизированным как Hydrator, после чего RenameMethodRector
        //переименовывает createObject/createArray.
        $factory = new Hydrator(self::class);
        $object = $factory->hydrateObject(['x' => 1]);
        $list = $factory->hydrateArray([['x' => 1]]);
    }
}

?>

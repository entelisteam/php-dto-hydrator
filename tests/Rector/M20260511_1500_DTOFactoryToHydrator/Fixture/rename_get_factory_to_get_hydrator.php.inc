<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\HydratorRegistry;
use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\SomeDTO;
use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\UnrelatedClass;

class UsesGetFactory
{
    public function build(): void
    {
        //standalone на DTO с трейтом — рейманим в getHydrator()
        $hydrator = SomeDTO::getFactory();

        //chain createObject — схлопывается chain-правилом в hydrateObject()
        $object = SomeDTO::getFactory()->createObject(['x' => 1]);

        //chain createArray — схлопывается chain-правилом в hydrateArray()
        $list = SomeDTO::getFactory()->createArray([['x' => 1]]);

        //registry — getFactory($x) тоже становится getHydrator($x)
        $registry = HydratorRegistry::getFactory(SomeDTO::class);

        //чужой класс с getFactory() — не трогаем
        $other = UnrelatedClass::getFactory();
    }
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\HydratorRegistry;
use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\SomeDTO;
use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\UnrelatedClass;

class UsesGetFactory
{
    public function build(): void
    {
        //standalone на DTO с трейтом — рейманим в getHydrator()
        $hydrator = SomeDTO::getHydrator();

        //chain createObject — схлопывается chain-правилом в hydrateObject()
        $object = SomeDTO::hydrateObject(['x' => 1]);

        //chain createArray — схлопывается chain-правилом в hydrateArray()
        $list = SomeDTO::hydrateArray([['x' => 1]]);

        //registry — getFactory($x) тоже становится getHydrator($x)
        $registry = HydratorRegistry::getHydrator(SomeDTO::class);

        //чужой класс с getFactory() — не трогаем
        $other = UnrelatedClass::getFactory();
    }
}

?>

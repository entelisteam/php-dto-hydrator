<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\SomeDTO;
use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\UnrelatedClass;

class UsesFromObject
{
    public function build(): void
    {
        //DTO с трейтом — рейманим
        $a = SomeDTO::fromObject(['x' => 1]);
        $b = SomeDTO::fromObject((object)['x' => 1], true);

        //чужой класс с fromObject() — не трогаем
        $c = UnrelatedClass::fromObject(['x' => 1]);
    }
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\SomeDTO;
use EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source\UnrelatedClass;

class UsesFromObject
{
    public function build(): void
    {
        //DTO с трейтом — рейманим
        $a = SomeDTO::hydrateObject(['x' => 1]);
        $b = SomeDTO::hydrateObject((object)['x' => 1], true);

        //чужой класс с fromObject() — не трогаем
        $c = UnrelatedClass::fromObject(['x' => 1]);
    }
}

?>

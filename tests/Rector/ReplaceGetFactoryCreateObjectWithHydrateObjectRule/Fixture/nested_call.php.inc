<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

use DriverDTO;
use CarDTO;

function nestedCall()
{
    $car = new CarDTO(
        'bmw',
        2023,
        DriverDTO::getFactory()->createObject(['name' => 'Mark', 'age' => 3])
    );
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

use DriverDTO;
use CarDTO;

function nestedCall()
{
    $car = new CarDTO(
        'bmw',
        2023,
        DriverDTO::hydrateObject(['name' => 'Mark', 'age' => 3])
    );
}

?>

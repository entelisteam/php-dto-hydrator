<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

use DriverDTO;

function multipleCalls()
{
    $driver1 = DriverDTO::getFactory()->createObject(['name' => 'Dim', 'age' => 37]);
    $driver2 = DriverDTO::getFactory()->createObject(['name' => 'Alex', 'age' => 35]);
    $driver3 = DriverDTO::getFactory()->createObject(['name' => 'Mark', 'age' => 28]);
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

use DriverDTO;

function multipleCalls()
{
    $driver1 = DriverDTO::hydrateObject(['name' => 'Dim', 'age' => 37]);
    $driver2 = DriverDTO::hydrateObject(['name' => 'Alex', 'age' => 35]);
    $driver3 = DriverDTO::hydrateObject(['name' => 'Mark', 'age' => 28]);
}

?>

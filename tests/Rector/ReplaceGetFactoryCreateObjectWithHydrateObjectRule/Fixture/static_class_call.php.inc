<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

use SomeClass;

function staticClassCall()
{
    $object = SomeClass::getFactory()->createObject(['name' => 'test']);
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

use SomeClass;

function staticClassCall()
{
    $object = SomeClass::hydrateObject(['name' => 'test']);
}

?>

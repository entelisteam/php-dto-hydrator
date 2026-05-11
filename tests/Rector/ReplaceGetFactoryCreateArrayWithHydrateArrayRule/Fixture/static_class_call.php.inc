<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

use SomeClass;

function staticClassCall()
{
    $array = SomeClass::getFactory()->createArray(['name' => 'test']);
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

use SomeClass;

function staticClassCall()
{
    $array = SomeClass::hydrateArray(['name' => 'test']);
}

?>

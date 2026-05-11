<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

use SomeClass;

function multipleCalls()
{
    $array1 = SomeClass::getFactory()->createArray(['name' => 'test1']);
    $array2 = SomeClass::getFactory()->createArray(['name' => 'test2']);
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

use SomeClass;

function multipleCalls()
{
    $array1 = SomeClass::hydrateArray(['name' => 'test1']);
    $array2 = SomeClass::hydrateArray(['name' => 'test2']);
}

?>

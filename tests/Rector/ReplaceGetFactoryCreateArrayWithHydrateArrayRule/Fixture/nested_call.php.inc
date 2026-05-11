<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

use SomeClass;

function nestedCall()
{
    $result = doSomething(SomeClass::getFactory()->createArray(['name' => 'test']));
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

use SomeClass;

function nestedCall()
{
    $result = doSomething(SomeClass::hydrateArray(['name' => 'test']));
}

?>

<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

function variableStaticCall()
{
    $className = 'SomeClass';
    $array = $className::getFactory()->createArray(['name' => 'test']);
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

function variableStaticCall()
{
    $className = 'SomeClass';
    $array = $className::hydrateArray(['name' => 'test']);
}

?>

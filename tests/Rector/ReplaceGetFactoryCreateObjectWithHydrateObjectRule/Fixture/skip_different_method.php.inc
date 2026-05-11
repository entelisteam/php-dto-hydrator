<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

use SomeClass;

function skipDifferentMethod()
{
    // Should NOT be changed - different method name
    $object = SomeClass::getFactory()->createArray(['data']);

    // Should NOT be changed - not getFactory
    $object = SomeClass::getBuilder()->createObject(['data']);

    // Should NOT be changed - regular method call, not static
    $object = $factory->createObject(['data']);
}

?>

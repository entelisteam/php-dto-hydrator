<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateArrayWithHydrateArrayRule\Fixture;

use SomeClass;

function skipDifferentMethod()
{
    // Не должно заменяться - другой метод
    $array = SomeClass::getFactory()->createObject(['name' => 'test']);

    // Не должно заменяться - не getFactory()
    $array = SomeClass::getSomething()->createArray(['name' => 'test']);

    // Не должно заменяться - не StaticCall
    $array = $instance->createArray(['name' => 'test']);
}

?>

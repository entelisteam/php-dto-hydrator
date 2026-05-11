<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

function variableStaticCall($instance)
{
    $jsonData = json_decode(json_encode($instance));
    $newInstance = $instance::getFactory()->createObject($jsonData);
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\ReplaceGetFactoryCreateObjectWithHydrateObjectRule\Fixture;

function variableStaticCall($instance)
{
    $jsonData = json_decode(json_encode($instance));
    $newInstance = $instance::hydrateObject($jsonData);
}

?>

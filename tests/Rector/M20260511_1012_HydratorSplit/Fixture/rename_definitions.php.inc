<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use Lbaf\Reflection\Definition\ArgDefinition;
use Lbaf\Reflection\Definition\ClassDefinition;
use Lbaf\Reflection\Definition\DefinitionType;

class UsesDefinitions
{
    public function build(): ClassDefinition
    {
        $arg = new ArgDefinition();
        $arg->definitionType = DefinitionType::SIMPLE;

        $class = new ClassDefinition();
        $class->properties = [$arg];
        return $class;
    }
}

?>
-----
<?php

namespace Tests\Rector\M20260511_1012_HydratorAndContainerSplit\Fixture;

use EntelisTeam\DTOHydrator\Definition\ClassDefinition;
use EntelisTeam\DTOHydrator\Definition\ArgDefinition;
use EntelisTeam\DTOHydrator\Definition\DefinitionType;

class UsesDefinitions
{
    public function build(): ClassDefinition
    {
        $arg = new ArgDefinition();
        $arg->definitionType = DefinitionType::SIMPLE;

        $class = new ClassDefinition();
        $class->properties = [$arg];
        return $class;
    }
}

?>

<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\Hydrator\Definition\ArgDefinition;
use EntelisTeam\Hydrator\Definition\ClassDefinition;
use EntelisTeam\Hydrator\Definition\DefinitionType;
use EntelisTeam\Hydrator\Exception\ArgumentTypeException;
use EntelisTeam\Hydrator\Exception\HydrationException;
use EntelisTeam\Hydrator\Exception\RequiredArgumentException;

class UsesDefinitionsAndExceptions
{
    public function inspect(ArgDefinition $arg, ClassDefinition $class, DefinitionType $type): void
    {
        throw new RequiredArgumentException($arg->reflection);
    }

    public function fallback(HydrationException $base, ArgumentTypeException $derived): void
    {
    }
}

?>
-----
<?php

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Fixture;

use EntelisTeam\DTOHydrator\Definition\ArgDefinition;
use EntelisTeam\DTOHydrator\Definition\ClassDefinition;
use EntelisTeam\DTOHydrator\Definition\DefinitionType;
use EntelisTeam\DTOHydrator\Exception\RequiredArgumentException;
use EntelisTeam\DTOHydrator\Exception\HydrationException;
use EntelisTeam\DTOHydrator\Exception\ArgumentTypeException;

class UsesDefinitionsAndExceptions
{
    public function inspect(ArgDefinition $arg, ClassDefinition $class, DefinitionType $type): void
    {
        throw new RequiredArgumentException($arg->reflection);
    }

    public function fallback(HydrationException $base, ArgumentTypeException $derived): void
    {
    }
}

?>

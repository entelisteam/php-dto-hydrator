<?php

declare(strict_types=1);

namespace EntelisTeam\DTOHydrator\Tests\Rector\M20260511_1500_DTOFactoryToHydrator\Source;

class UnrelatedClass
{
    public static function getFactory(): self
    {
        return new self();
    }

    public static function fromObject(array $data): self
    {
        return new self();
    }
}

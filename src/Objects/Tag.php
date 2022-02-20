<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Objects;

class Tag
{
    public function __construct(
        protected string $name,
        protected string $value,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

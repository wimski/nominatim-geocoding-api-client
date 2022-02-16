<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts;

interface RequestParametersInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}

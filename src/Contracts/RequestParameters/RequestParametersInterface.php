<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts\RequestParameters;

interface RequestParametersInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}

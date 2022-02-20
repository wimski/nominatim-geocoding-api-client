<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts\Config;

interface LocationIqConfigInterface extends ConfigInterface
{
    public function getKey(): string;
}

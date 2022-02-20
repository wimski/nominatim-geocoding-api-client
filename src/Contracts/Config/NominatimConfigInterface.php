<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts\Config;

interface NominatimConfigInterface extends ConfigInterface
{
    public function getUserAgent(): string;
    public function getEmail(): string;
}

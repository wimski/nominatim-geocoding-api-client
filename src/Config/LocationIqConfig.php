<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Config;

use Wimski\Nominatim\Contracts\Config\LocationIqConfigInterface;

class LocationIqConfig extends AbstractConfig implements LocationIqConfigInterface
{
    public function __construct(
        protected string $key,
        string $url = 'https://eu1.locationiq.com/v1',
        string $forwardGeocodingEndpoint = 'search.php',
        string $reverseGeocodingEndpoint = 'reverse.php',
        string $language = null,
    ) {
        parent::__construct(
            $url,
            $forwardGeocodingEndpoint,
            $reverseGeocodingEndpoint,
            $language,
        );
    }

    public function getKey(): string
    {
        return $this->key;
    }
}

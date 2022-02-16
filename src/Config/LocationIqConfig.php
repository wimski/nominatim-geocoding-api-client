<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Config;

class LocationIqConfig extends AbstractConfig
{
    public function __construct(
        protected string $key,
        string $url = 'https://eu1.locationiq.com/v1',
        string $forwardGeocodingEndpoint = '/search.php',
        string $reverseGeocodingEndpoint = '/reverse.php',
        string $language = null,
    ) {
        parent::__construct(
            $url,
            $forwardGeocodingEndpoint,
            $reverseGeocodingEndpoint,
            $language,
        );

        $this->key = trim($this->key);
    }

    public function getKey(): string
    {
        return $this->key;
    }
}

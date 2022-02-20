<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Config;

use Wimski\Nominatim\Contracts\Config\NominatimConfigInterface;

class NominatimConfig extends AbstractConfig implements NominatimConfigInterface
{
    public function __construct(
        protected string $userAgent,
        protected string $email,
        string $url = 'https://nominatim.openstreetmap.org',
        string $forwardGeocodingEndpoint = 'search',
        string $reverseGeocodingEndpoint = 'reverse',
        string $language = null,
    ) {
        parent::__construct(
            $url,
            $forwardGeocodingEndpoint,
            $reverseGeocodingEndpoint,
            $language,
        );
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

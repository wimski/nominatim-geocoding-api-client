<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Config;

use Wimski\Nominatim\Contracts\ConfigInterface;

abstract class AbstractConfig implements ConfigInterface
{
    public function __construct(
        protected string $url,
        protected string $forwardGeocodingEndpoint,
        protected string $reverseGeocodingEndpoint,
        protected ?string $language = null,
    ) {
        $this->url                      = rtrim(trim($this->url), '/');
        $this->forwardGeocodingEndpoint = '/' . ltrim(trim($this->forwardGeocodingEndpoint), '/');
        $this->reverseGeocodingEndpoint = '/' . ltrim(trim($this->reverseGeocodingEndpoint), '/');
        $this->language                 = $this->language ?? 'en-US';
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getForwardGeocodingEndpoint(): string
    {
        return $this->forwardGeocodingEndpoint;
    }

    public function getReverseGeocodingEndpoint(): string
    {
        return $this->reverseGeocodingEndpoint;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}

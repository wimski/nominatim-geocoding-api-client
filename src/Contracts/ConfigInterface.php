<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts;

interface ConfigInterface
{
    public function getUrl(): string;
    public function getForwardGeocodingEndpoint(): string;
    public function getReverseGeocodingEndpoint(): string;
    public function getLanguage(): string;
}

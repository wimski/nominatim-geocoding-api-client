<?php

declare(strict_types=1);

namespace Wimski\Nominatim\GeocoderServices;

use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Contracts\Config\ConfigInterface;
use Wimski\Nominatim\Contracts\Config\GenericConfigInterface;
use Wimski\Nominatim\Contracts\Transformers\GeocodingResponseTransformerInterface;

class GenericGeocoderService extends AbstractGeocoderService
{
    public function __construct(
        ClientInterface $client,
        GeocodingResponseTransformerInterface $responseTransformer,
        protected GenericConfigInterface $config,
    ) {
        parent::__construct($client, $responseTransformer);
    }

    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}

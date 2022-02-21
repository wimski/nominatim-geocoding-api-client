<?php

declare(strict_types=1);

namespace Wimski\Nominatim\GeocoderServices;

use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Contracts\Config\ConfigInterface;
use Wimski\Nominatim\Contracts\Config\LocationIqConfigInterface;
use Wimski\Nominatim\Contracts\RequestParameters\RequestParametersInterface;
use Wimski\Nominatim\Contracts\Transformers\GeocodingResponseTransformerInterface;

class LocationIqGeocoderService extends AbstractGeocoderService
{
    public function __construct(
        ClientInterface $client,
        GeocodingResponseTransformerInterface $responseTransformer,
        protected LocationIqConfigInterface $config,
    ) {
        parent::__construct($client, $responseTransformer);
    }

    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    protected function convertParametersToArray(RequestParametersInterface $parameters): array
    {
        $array = parent::convertParametersToArray($parameters);

        $array['key']    = $this->config->getKey();
        $array['source'] = 'nom';

        return $array;
    }
}

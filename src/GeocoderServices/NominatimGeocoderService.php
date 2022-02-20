<?php

declare(strict_types=1);

namespace Wimski\Nominatim\GeocoderServices;

use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Contracts\Config\ConfigInterface;
use Wimski\Nominatim\Contracts\Config\NominatimConfigInterface;
use Wimski\Nominatim\Contracts\RequestParameters\RequestParametersInterface;
use Wimski\Nominatim\Contracts\Transformers\GeocodingResponseTransformerInterface;

class NominatimGeocoderService extends AbstractGeocoderService
{
    public function __construct(
        ClientInterface $client,
        GeocodingResponseTransformerInterface $responseTransformer,
        protected NominatimConfigInterface $config,
    ) {
        parent::__construct($client, $responseTransformer);
    }

    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    protected function getHeaders(): array
    {
        return array_merge(parent::getHeaders(), [
            'User-Agent' => $this->config->getUserAgent(),
        ]);
    }

    protected function convertParametersToArray(RequestParametersInterface $parameters): array
    {
        $array = parent::convertParametersToArray($parameters);

        $array['email'] = $this->config->getEmail();

        return $array;
    }
}

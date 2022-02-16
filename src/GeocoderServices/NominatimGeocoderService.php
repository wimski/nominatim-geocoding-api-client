<?php

declare(strict_types=1);

namespace Wimski\Nominatim\GeocoderServices;

use Wimski\Nominatim\Config\NominatimConfig;
use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Contracts\ConfigInterface;
use Wimski\Nominatim\Contracts\RequestParametersInterface;

class NominatimGeocoderService extends AbstractGeocoderService
{
    public function __construct(
        ClientInterface $client,
        protected NominatimConfig $config,
    ) {
        parent::__construct($client);
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

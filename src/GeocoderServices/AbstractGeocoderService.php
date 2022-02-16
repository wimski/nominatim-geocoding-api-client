<?php

declare(strict_types=1);

namespace Wimski\Nominatim\GeocoderServices;

use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Contracts\ConfigInterface;
use Wimski\Nominatim\Contracts\GeocoderServiceInterface;
use Wimski\Nominatim\Contracts\RequestParametersInterface;
use Wimski\Nominatim\Exceptions\RequestException;
use Wimski\Nominatim\RequestParameters\ForwardGeocodingRequestParameters;
use Wimski\Nominatim\RequestParameters\ReverseGeocodingRequestParameters;
use Wimski\Nominatim\Responses\ForwardGeocodingResponse;
use Wimski\Nominatim\Responses\ReverseGeocodingResponse;

abstract class AbstractGeocoderService implements GeocoderServiceInterface
{
    public function __construct(
        protected ClientInterface $client,
    ) {
    }

    public function requestForwardGeocoding(ForwardGeocodingRequestParameters $parameters): ForwardGeocodingResponse
    {
        $uri = $this->getConfig()->getUrl() . $this->getConfig()->getForwardGeocodingEndpoint();

        $response = $this->request($uri, $parameters);

        return new ForwardGeocodingResponse($response);
    }

    public function requestReverseGeocoding(ReverseGeocodingRequestParameters $parameters): ReverseGeocodingResponse
    {
        $uri = $this->getConfig()->getUrl() . $this->getConfig()->getReverseGeocodingEndpoint();

        $response = $this->request($uri, $parameters);

        return new ReverseGeocodingResponse($response);
    }

    abstract protected function getConfig(): ConfigInterface;

    /**
     * @return array<string, string>
     */
    protected function getHeaders(): array
    {
        return [
            'Accept-Language' => $this->getConfig()->getLanguage(),
        ];
    }

    /**
     * @param RequestParametersInterface $parameters
     * @return array<string, mixed>
     */
    protected function convertParametersToArray(RequestParametersInterface $parameters): array
    {
        return array_merge($parameters->toArray(), [
            'format' => 'json',
        ]);
    }

    /**
     * @param string                     $uri
     * @param RequestParametersInterface $parameters
     * @return ResponseInterface
     * @throws RequestException
     */
    protected function request(string $uri, RequestParametersInterface $parameters): ResponseInterface
    {
        return $this->client->request(
            $uri,
            $this->getHeaders(),
            $this->convertParametersToArray($parameters),
        );
    }
}

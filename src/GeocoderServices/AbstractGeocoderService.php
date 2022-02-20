<?php

declare(strict_types=1);

namespace Wimski\Nominatim\GeocoderServices;

use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Contracts\Config\ConfigInterface;
use Wimski\Nominatim\Contracts\GeocoderServiceInterface;
use Wimski\Nominatim\Contracts\RequestParameters\ForwardGeocodingRequestParametersInterface;
use Wimski\Nominatim\Contracts\RequestParameters\RequestParametersInterface;
use Wimski\Nominatim\Contracts\RequestParameters\ReverseGeocodingRequestParametersInterface;
use Wimski\Nominatim\Contracts\Responses\ForwardGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ReverseGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Transformers\GeocodingResponseTransformerInterface;
use Wimski\Nominatim\Exceptions\RequestException;

abstract class AbstractGeocoderService implements GeocoderServiceInterface
{
    public function __construct(
        protected ClientInterface $client,
        protected GeocodingResponseTransformerInterface $responseTransformer,
    ) {
    }

    public function requestForwardGeocoding(
        ForwardGeocodingRequestParametersInterface $parameters,
    ): ForwardGeocodingResponseInterface {
        $uri = $this->makeUri(
            $this->getConfig()->getUrl(),
            $this->getConfig()->getForwardGeocodingEndpoint(),
        );

        $response = $this->request($uri, $parameters);

        return $this->responseTransformer->transformForwardResponse($response);
    }

    public function requestReverseGeocoding(
        ReverseGeocodingRequestParametersInterface $parameters,
    ): ReverseGeocodingResponseInterface {
        $uri = $this->makeUri(
            $this->getConfig()->getUrl(),
            $this->getConfig()->getReverseGeocodingEndpoint(),
        );

        $response = $this->request($uri, $parameters);

        return $this->responseTransformer->transformReverseResponse($response);
    }

    abstract protected function getConfig(): ConfigInterface;

    protected function makeUri(string $uri, string $endpoint): string
    {
        return rtrim($uri, '/') . '/' . ltrim($endpoint, '/');
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
}

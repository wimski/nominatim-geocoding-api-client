<?php

declare(strict_types=1);

namespace Wimski\Nominatim;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriFactoryInterface;
use Throwable;
use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Exceptions\HttpException;
use Wimski\Nominatim\Exceptions\RequestException;

class Client implements ClientInterface
{
    protected HttpClientInterface $client;
    protected RequestFactoryInterface $requestFactory;
    protected UriFactoryInterface $uriFactory;

    public function __construct(
        ?HttpClientInterface $client = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?UriFactoryInterface $uriFactory = null,
    ) {
        $this->client         = $client ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->uriFactory     = $uriFactory ?? Psr17FactoryDiscovery::findUriFactory();
    }

    public function request(string $uri, array $headers = [], array $parameters = []): ResponseInterface
    {
        $uriWithParameters = $this->uriFactory
            ->createUri($uri)
            ->withQuery(http_build_query($parameters));

        $request = $this->requestFactory->createRequest('GET', $uriWithParameters);

        foreach ($headers as $name => $value) {
            $request = $request->withAddedHeader($name, $value);
        }

        try {
            $response = $this->client->sendRequest($request);

            if ($response->getStatusCode() >= 400) {
                throw new HttpException(
                    (string) $response->getBody(),
                    $response->getStatusCode(),
                );
            }

            return $response;
        } catch (Throwable $exception) {
            throw new RequestException($request, $exception);
        }
    }
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests;

use Swis\Http\Fixture\Client as FixtureClient;
use Swis\Http\Fixture\ResponseBuilder;
use Wimski\Nominatim\Client;
use Wimski\Nominatim\Config\NominatimConfig;
use Wimski\Nominatim\GeocoderServices\NominatimGeocoderService;
use Wimski\Nominatim\RequestParameters\ForwardGeocodingQueryRequestParameters;
use Wimski\Nominatim\Transformers\GeocodingResponseTransformer;

class IntegrationTest extends AbstractTest
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $responseBuilder = new ResponseBuilder(__DIR__ . DIRECTORY_SEPARATOR . 'fixtures');
        $fixtureClient   = new FixtureClient($responseBuilder);

        $this->client = new Client($fixtureClient);
    }

    /**
     * @test
     */
    public function it_makes_a_nominatim_forward_geocoding_query_request(): void
    {
        $config = new NominatimConfig('user-agent', 'email@provider.net');

        $service = new NominatimGeocoderService(
            $this->client,
            new GeocodingResponseTransformer(),
            $config,
        );

        $request = ForwardGeocodingQueryRequestParameters::make('query');

        $response = $service->requestForwardGeocoding($request);

        static::assertCount(2, $response->getItems());

        static::assertSame(12345, $response->getItems()[0]->getPlaceId());
        static::assertSame('Beautiful Building', $response->getItems()[0]->getDisplayName());

        static::assertSame(67890, $response->getItems()[1]->getPlaceId());
        static::assertSame('Statue of Something', $response->getItems()[1]->getDisplayName());
    }
}

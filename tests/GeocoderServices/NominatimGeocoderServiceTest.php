<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\GeocoderServices;

use Mockery;
use Mockery\MockInterface;
use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\Contracts\Config\NominatimConfigInterface;
use Wimski\Nominatim\Contracts\RequestParameters\ForwardGeocodingRequestParametersInterface;
use Wimski\Nominatim\Contracts\RequestParameters\ReverseGeocodingRequestParametersInterface;
use Wimski\Nominatim\Contracts\Responses\ForwardGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ReverseGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Transformers\GeocodingResponseTransformerInterface;
use Wimski\Nominatim\GeocoderServices\NominatimGeocoderService;
use Wimski\Nominatim\Tests\AbstractTest;

class NominatimGeocoderServiceTest extends AbstractTest
{
    protected NominatimGeocoderService $service;

    /**
     * @var ClientInterface|MockInterface
     */
    protected $client;

    /**
     * @var GeocodingResponseTransformerInterface|MockInterface
     */
    protected $responseTransformer;

    /**
     * @var NominatimConfigInterface|MockInterface
     */
    protected $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client              = Mockery::mock(ClientInterface::class);
        $this->responseTransformer = Mockery::mock(GeocodingResponseTransformerInterface::class);
        $this->config              = Mockery::mock(NominatimConfigInterface::class);

        $this->config
            ->shouldReceive('getUrl')->once()->andReturn('https://nominatim.mysite.com/')->getMock()
            ->shouldReceive('getLanguage')->once()->andReturn('nl')->getMock()
            ->shouldReceive('getUserAgent')->once()->andReturn('user-agent')->getMock()
            ->shouldReceive('getEmail')->once()->andReturn('email@host.com')->getMock();

        $this->service = new NominatimGeocoderService(
            $this->client,
            $this->responseTransformer,
            $this->config,
        );
    }

    /**
     * @test
     */
    public function it_makes_a_forward_geocoding_request(): void
    {
        $response = Mockery::mock(ResponseInterface::class);

        $this->config
            ->shouldReceive('getForwardGeocodingEndpoint')
            ->once()
            ->andReturn('/forwards');

        $this->client
            ->shouldReceive('request')
            ->once()
            ->with('https://nominatim.mysite.com/forwards', [
                'Accept-Language' => 'nl',
                'User-Agent'      => 'user-agent',
            ], [
                'param'  => 'value',
                'format' => 'json',
                'email'  => 'email@host.com',
            ])
            ->andReturn($response);

        $this->responseTransformer
            ->shouldReceive('transformForwardResponse')
            ->once()
            ->with($response)
            ->andReturn(Mockery::mock(ForwardGeocodingResponseInterface::class));

        /** @var ForwardGeocodingRequestParametersInterface|MockInterface $parameters */
        $parameters = Mockery::mock(ForwardGeocodingRequestParametersInterface::class)
            ->shouldReceive('toArray')
            ->once()
            ->andReturn(['param' => 'value'])
            ->getMock();

        $this->service->requestForwardGeocoding($parameters);
    }

    /**
     * @test
     */
    public function it_makes_a_reverse_geocoding_request(): void
    {
        $response = Mockery::mock(ResponseInterface::class);

        $this->config
            ->shouldReceive('getReverseGeocodingEndpoint')
            ->once()
            ->andReturn('/reversed');

        $this->client
            ->shouldReceive('request')
            ->once()
            ->with('https://nominatim.mysite.com/reversed', [
                'Accept-Language' => 'nl',
                'User-Agent'      => 'user-agent',
            ], [
                'param'  => 'value',
                'format' => 'json',
                'email'  => 'email@host.com',
            ])
            ->andReturn($response);

        $this->responseTransformer
            ->shouldReceive('transformReverseResponse')
            ->once()
            ->with($response)
            ->andReturn(Mockery::mock(ReverseGeocodingResponseInterface::class));

        /** @var ReverseGeocodingRequestParametersInterface|MockInterface $parameters */
        $parameters = Mockery::mock(ReverseGeocodingRequestParametersInterface::class)
            ->shouldReceive('toArray')
            ->once()
            ->andReturn(['param' => 'value'])
            ->getMock();

        $this->service->requestReverseGeocoding($parameters);
    }
}

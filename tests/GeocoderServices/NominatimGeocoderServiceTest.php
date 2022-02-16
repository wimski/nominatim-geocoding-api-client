<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\GeocoderServices;

use Mockery;
use Mockery\MockInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Wimski\Nominatim\Config\NominatimConfig;
use Wimski\Nominatim\Contracts\ClientInterface;
use Wimski\Nominatim\GeocoderServices\NominatimGeocoderService;
use Wimski\Nominatim\RequestParameters\ForwardGeocodingQueryRequestParameters;
use Wimski\Nominatim\RequestParameters\ReverseGeocodingRequestParameters;
use Wimski\Nominatim\Tests\AbstractTest;

class NominatimGeocoderServiceTest extends AbstractTest
{
    protected NominatimGeocoderService $service;

    /**
     * @var ClientInterface|MockInterface
     */
    protected $client;

    /**
     * @var NominatimConfig|MockInterface
     */
    protected $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Mockery::mock(ClientInterface::class);
        $this->config = Mockery::mock(NominatimConfig::class);

        $this->config
            ->shouldReceive('getUrl')->once()->andReturn('https://nominatim.mysite.com/')->getMock()
            ->shouldReceive('getLanguage')->once()->andReturn('nl')->getMock()
            ->shouldReceive('getUserAgent')->once()->andReturn('user-agent')->getMock()
            ->shouldReceive('getEmail')->once()->andReturn('email@host.com')->getMock();

        $this->service = new NominatimGeocoderService(
            $this->client,
            $this->config,
        );
    }

    /**
     * @test
     */
    public function it_makes_a_forward_geocoding_request(): void
    {
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
            ->andReturn($this->mockResponse());

        /** @var ForwardGeocodingQueryRequestParameters|MockInterface $parameters */
        $parameters = Mockery::mock(ForwardGeocodingQueryRequestParameters::class)
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
            ->andReturn($this->mockResponse());

        /** @var ReverseGeocodingRequestParameters|MockInterface $parameters */
        $parameters = Mockery::mock(ReverseGeocodingRequestParameters::class)
            ->shouldReceive('toArray')
            ->once()
            ->andReturn(['param' => 'value'])
            ->getMock();

        $this->service->requestReverseGeocoding($parameters);
    }

    /**
     * @return ResponseInterface|MockInterface
     */
    protected function mockResponse()
    {
        $stream = Mockery::mock(StreamInterface::class)
            ->shouldReceive('__toString')
            ->once()
            ->andReturn('{"data":"contents"}')
            ->getMock();

        /** @var ResponseInterface|MockInterface $response */
        $response = Mockery::mock(ResponseInterface::class)
            ->shouldReceive('getBody')
            ->once()
            ->andReturn($stream)
            ->getMock();

        return $response;
    }
}

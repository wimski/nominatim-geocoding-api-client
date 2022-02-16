<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests;

use Exception;
use Mockery;
use Mockery\MockInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Wimski\Nominatim\Client;
use Wimski\Nominatim\Exceptions\RequestException;

class ClientTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_makes_a_request(): void
    {
        $uri      = $this->mockUri();
        $request  = $this->mockRequest();
        $response = $this->mockResponse(200);

        /** @var HttpClientInterface|MockInterface $httpClient */
        $httpClient = Mockery::mock(HttpClientInterface::class)
            ->shouldReceive('sendRequest')
            ->once()
            ->with($request)
            ->andReturn($response)
            ->getMock();

        $client = new Client(
            $httpClient,
            $this->mockRequestFactory($uri, $request),
            $this->mockUriFactory($uri),
        );

        $client->request(
            'https://some.site',
            ['My-Header' => 'some-value'],
            ['param' => 'value'],
        );
    }

    /**
     * @test
     * @depends it_makes_a_request
     */
    public function it_throws_an_exception_when_the_status_code_is_equal_or_greater_than_400(): void
    {
        static::expectException(RequestException::class);

        $uri      = $this->mockUri();
        $request  = $this->mockRequest();

        $stream = Mockery::mock(StreamInterface::class)
            ->shouldReceive('__toString')
            ->once()
            ->andReturn('contents')
            ->getMock();

        $response = $this->mockResponse(500, 2)
            ->shouldReceive('getBody')
            ->once()
            ->andReturn($stream)
            ->getMock();

        /** @var HttpClientInterface|MockInterface $httpClient */
        $httpClient = Mockery::mock(HttpClientInterface::class)
            ->shouldReceive('sendRequest')
            ->once()
            ->with($request)
            ->andReturn($response)
            ->getMock();

        $client = new Client(
            $httpClient,
            $this->mockRequestFactory($uri, $request),
            $this->mockUriFactory($uri),
        );

        $client->request(
            'https://some.site',
            ['My-Header' => 'some-value'],
            ['param' => 'value'],
        );
    }

    /**
     * @test
     * @depends it_makes_a_request
     */
    public function it_throws_an_exception_when_the_request_fails(): void
    {
        static::expectException(RequestException::class);

        $uri     = $this->mockUri();
        $request = $this->mockRequest();

        /** @var HttpClientInterface|MockInterface $httpClient */
        $httpClient = Mockery::mock(HttpClientInterface::class)
            ->shouldReceive('sendRequest')
            ->once()
            ->with($request)
            ->andThrow(Mockery::mock(Exception::class))
            ->getMock();

        $client = new Client(
            $httpClient,
            $this->mockRequestFactory($uri, $request),
            $this->mockUriFactory($uri),
        );

        $client->request(
            'https://some.site',
            ['My-Header' => 'some-value'],
            ['param' => 'value'],
        );
    }

    /**
     * @return UriInterface|MockInterface
     */
    protected function mockUri()
    {
        /** @var UriInterface|MockInterface $uri */
        $uri = Mockery::mock(UriInterface::class)
            ->shouldReceive('withQuery')
            ->once()
            ->with('param=value')
            ->andReturnSelf()
            ->getMock();

        return $uri;
    }

    /**
     * @param UriInterface|MockInterface $uri
     * @return MockInterface|UriFactoryInterface
     */
    protected function mockUriFactory($uri)
    {
        /** @var UriFactoryInterface|MockInterface $factory */
        $factory = Mockery::mock(UriFactoryInterface::class)
            ->shouldReceive('createUri')
            ->once()
            ->with('https://some.site')
            ->andReturn($uri)
            ->getMock();

        return $factory;
    }

    /**
     * @return MockInterface|RequestInterface
     */
    protected function mockRequest()
    {
        /** @var RequestInterface|MockInterface $request */
        $request = Mockery::mock(RequestInterface::class)
            ->shouldReceive('withAddedHeader')
            ->once()
            ->with('My-Header', 'some-value')
            ->andReturnSelf()
            ->getMock();

        return $request;
    }

    /**
     * @param UriInterface|MockInterface     $uri
     * @param RequestInterface|MockInterface $request
     * @return MockInterface|RequestFactoryInterface
     */
    protected function mockRequestFactory($uri, $request)
    {
        /** @var RequestFactoryInterface|MockInterface $factory */
        $factory = Mockery::mock(RequestFactoryInterface::class)
            ->shouldReceive('createRequest')
            ->once()
            ->with('GET', $uri)
            ->andReturn($request)
            ->getMock();

        return $factory;
    }

    /**
     * @param int $statusCode
     * @param int $times
     * @return MockInterface|ResponseInterface
     */
    protected function mockResponse(int $statusCode, int $times = 1)
    {
        /** @var ResponseInterface|MockInterface $response */
        $response = Mockery::mock(ResponseInterface::class)
            ->shouldReceive('getStatusCode')
            ->times($times)
            ->andReturn($statusCode)
            ->getMock();

        return $response;
    }
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Exceptions;

use Exception;
use Mockery;
use Mockery\MockInterface;
use Psr\Http\Message\RequestInterface;
use Wimski\Nominatim\Exceptions\HttpException;
use Wimski\Nominatim\Exceptions\RequestException;
use Wimski\Nominatim\Tests\AbstractTest;

class RequestExceptionTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_a_default_message_and_code(): void
    {
        $exception = new RequestException(
            Mockery::mock(RequestInterface::class),
            Mockery::mock(Exception::class),
        );

        static::assertSame('Request failed', $exception->getMessage());
        static::assertSame(0, $exception->getCode());
    }

    /**
     * @test
     */
    public function it_returns_the_request(): void
    {
        $request = Mockery::mock(RequestInterface::class);

        $exception = new RequestException(
            $request,
            Mockery::mock(Exception::class),
        );

        static::assertSame($request, $exception->getRequest());
    }

    /**
     * @test
     */
    public function it_returns_the_status_code_if_the_previous_exception_is_an_http_exception(): void
    {
        /** @var HttpException|MockInterface $previous */
        $previous = Mockery::mock(HttpException::class)
            ->shouldReceive('getStatusCode')
            ->once()
            ->andReturn(500)
            ->getMock();

        $exception = new RequestException(
            Mockery::mock(RequestInterface::class),
            $previous,
        );

        static::assertSame(500, $exception->getStatusCode());
    }

    /**
     * @test
     */
    public function it_returns_null_if_the_previous_exception_is_an_http_exception(): void
    {
        $exception = new RequestException(
            Mockery::mock(RequestInterface::class),
            Mockery::mock(Exception::class),
        );

        static::assertNull($exception->getStatusCode());
    }
}

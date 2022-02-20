<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Exceptions;

use Exception;
use Mockery;
use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Exceptions\ResponseException;
use Wimski\Nominatim\Tests\AbstractTest;

class ResponseExceptionTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_a_default_message_and_code(): void
    {
        $exception = new ResponseException(
            Mockery::mock(ResponseInterface::class),
            Mockery::mock(Exception::class),
        );

        static::assertSame('Invalid response', $exception->getMessage());
        static::assertSame(0, $exception->getCode());
    }

    /**
     * @test
     */
    public function it_returns_the_response(): void
    {
        $response = Mockery::mock(ResponseInterface::class);

        $exception = new ResponseException(
            $response,
            Mockery::mock(Exception::class),
        );

        static::assertSame($response, $exception->getResponse());
    }
}

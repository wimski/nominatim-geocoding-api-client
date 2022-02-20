<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Traits;

use Mockery;
use Mockery\MockInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

trait MocksResponse
{
    /**
     * @param string $json
     * @return ResponseInterface|MockInterface
     */
    protected function mockResponse(string $json)
    {
        $stream = Mockery::mock(StreamInterface::class)
            ->shouldReceive('__toString')
            ->once()
            ->andReturn($json)
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

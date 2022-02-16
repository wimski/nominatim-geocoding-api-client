<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Exceptions;

use Wimski\Nominatim\Exceptions\HttpException;
use Wimski\Nominatim\Tests\AbstractTest;

class HttpExceptionTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_the_status_code(): void
    {
        $exception = new HttpException('message', 500);

        static::assertSame(500, $exception->getStatusCode());
    }
}

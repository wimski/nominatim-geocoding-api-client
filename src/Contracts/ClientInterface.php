<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts;

use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Exceptions\RequestException;

interface ClientInterface
{
    /**
     * @param string                $uri
     * @param array<string, string> $headers
     * @param array<string, mixed>  $parameters
     * @return ResponseInterface
     * @throws RequestException
     */
    public function request(string $uri, array $headers = [], array $parameters = []): ResponseInterface;
}

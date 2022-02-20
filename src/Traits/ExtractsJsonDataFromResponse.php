<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Traits;

use JsonException;
use Psr\Http\Message\ResponseInterface;

trait ExtractsJsonDataFromResponse
{
    /**
     * @param ResponseInterface $response
     * @return array<string, mixed>[]
     * @throws JsonException
     */
    protected function extractJsonDataFromResponse(ResponseInterface $response): array
    {
        /** @var array<string, mixed>[] $data */
        $data = json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Responses;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractGeocodingResponse
{
    /**
     * @var array<string, mixed>
     */
    protected array $data;

    public function __construct(
        ResponseInterface $response,
    ) {
        $this->data = json_decode((string) $response->getBody(), true);
    }
}

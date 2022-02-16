<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Responses;

use JsonException;
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
        try {
            /** @var array<string, mixed> $data */
            $data = json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            $this->data = $data;
        } catch (JsonException $exception) {
            $this->data = [];
        }
    }
}

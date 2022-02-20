<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Responses;

use InvalidArgumentException;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ReverseGeocodingResponseInterface;
use Wimski\Nominatim\Traits\ExtractsJsonDataFromResponse;

class ReverseGeocodingResponse extends AbstractGeocodingResponseItem implements ReverseGeocodingResponseInterface
{
    use ExtractsJsonDataFromResponse;

    /**
     * @param ResponseInterface $response
     * @throws JsonException|InvalidArgumentException
     */
    public function __construct(ResponseInterface $response)
    {
        $data = $this->extractJsonDataFromResponse($response);

        $this->validate($data);
        $this->extract($data);
    }
}

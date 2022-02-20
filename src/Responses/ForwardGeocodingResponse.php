<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Responses;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ForwardGeocodingResponseInterface;
use Wimski\Nominatim\Traits\ExtractsJsonDataFromResponse;

class ForwardGeocodingResponse implements ForwardGeocodingResponseInterface
{
    use ExtractsJsonDataFromResponse;

    /**
     * @var ForwardGeocodingResponseItem[]
     */
    protected array $items = [];

    /**
     * @param ResponseInterface $response
     * @throws JsonException
     */
    public function __construct(ResponseInterface $response)
    {
        $data = $this->extractJsonDataFromResponse($response);

        foreach ($data as $item) {
            $this->items[] = new ForwardGeocodingResponseItem($item);
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }
}

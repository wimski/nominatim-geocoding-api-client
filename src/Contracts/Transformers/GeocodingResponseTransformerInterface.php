<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts\Transformers;

use Psr\Http\Message\ResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ForwardGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ReverseGeocodingResponseInterface;
use Wimski\Nominatim\Exceptions\ResponseException;

interface GeocodingResponseTransformerInterface
{
    /**
     * @param ResponseInterface $response
     * @return ForwardGeocodingResponseInterface
     * @throws ResponseException
     */
    public function transformForwardResponse(ResponseInterface $response): ForwardGeocodingResponseInterface;

    /**
     * @param ResponseInterface $response
     * @return ReverseGeocodingResponseInterface
     * @throws ResponseException
     */
    public function transformReverseResponse(ResponseInterface $response): ReverseGeocodingResponseInterface;
}

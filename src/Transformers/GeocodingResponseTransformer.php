<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Transformers;

use Psr\Http\Message\ResponseInterface;
use Throwable;
use Wimski\Nominatim\Contracts\Responses\ForwardGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ReverseGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Transformers\GeocodingResponseTransformerInterface;
use Wimski\Nominatim\Exceptions\ResponseException;
use Wimski\Nominatim\Responses\ForwardGeocodingResponse;
use Wimski\Nominatim\Responses\ReverseGeocodingResponse;

class GeocodingResponseTransformer implements GeocodingResponseTransformerInterface
{
    public function transformForwardResponse(ResponseInterface $response): ForwardGeocodingResponseInterface
    {
        try {
            return new ForwardGeocodingResponse($response);
        } catch (Throwable $exception) {
            throw new ResponseException($response, $exception);
        }
    }

    public function transformReverseResponse(ResponseInterface $response): ReverseGeocodingResponseInterface
    {
        try {
            return new ReverseGeocodingResponse($response);
        } catch (Throwable $exception) {
            throw new ResponseException($response, $exception);
        }
    }
}

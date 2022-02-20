<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts;

use Wimski\Nominatim\Contracts\RequestParameters\ForwardGeocodingRequestParametersInterface;
use Wimski\Nominatim\Contracts\RequestParameters\ReverseGeocodingRequestParametersInterface;
use Wimski\Nominatim\Contracts\Responses\ForwardGeocodingResponseInterface;
use Wimski\Nominatim\Contracts\Responses\ReverseGeocodingResponseInterface;
use Wimski\Nominatim\Exceptions\RequestException;
use Wimski\Nominatim\Exceptions\ResponseException;

interface GeocoderServiceInterface
{
    /**
     * @param ForwardGeocodingRequestParametersInterface $parameters
     * @return ForwardGeocodingResponseInterface
     * @throws RequestException|ResponseException
     */
    public function requestForwardGeocoding(
        ForwardGeocodingRequestParametersInterface $parameters,
    ): ForwardGeocodingResponseInterface;

    /**
     * @param ReverseGeocodingRequestParametersInterface $parameters
     * @return ReverseGeocodingResponseInterface
     * @throws RequestException|ResponseException
     */
    public function requestReverseGeocoding(
        ReverseGeocodingRequestParametersInterface $parameters,
    ): ReverseGeocodingResponseInterface;
}

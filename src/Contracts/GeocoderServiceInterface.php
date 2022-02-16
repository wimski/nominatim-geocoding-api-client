<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts;

use Wimski\Nominatim\Exceptions\RequestException;
use Wimski\Nominatim\RequestParameters\ForwardGeocodingRequestParameters;
use Wimski\Nominatim\RequestParameters\ReverseGeocodingRequestParameters;
use Wimski\Nominatim\Responses\ForwardGeocodingResponse;
use Wimski\Nominatim\Responses\ReverseGeocodingResponse;

interface GeocoderServiceInterface
{
    /**
     * @param ForwardGeocodingRequestParameters $parameters
     * @return ForwardGeocodingResponse
     * @throws RequestException
     */
    public function requestForwardGeocoding(ForwardGeocodingRequestParameters $parameters): ForwardGeocodingResponse;

    /**
     * @param ReverseGeocodingRequestParameters $parameters
     * @return ReverseGeocodingResponse
     * @throws RequestException
     */
    public function requestReverseGeocoding(ReverseGeocodingRequestParameters $parameters): ReverseGeocodingResponse;
}

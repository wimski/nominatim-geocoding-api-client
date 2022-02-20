<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts\Responses;

interface ForwardGeocodingResponseInterface
{
    /**
     * @return ForwardGeocodingResponseItemInterface[]
     */
    public function getItems(): array;
}

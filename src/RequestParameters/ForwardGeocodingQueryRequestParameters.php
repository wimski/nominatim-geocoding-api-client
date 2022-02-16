<?php

declare(strict_types=1);

namespace Wimski\Nominatim\RequestParameters;

class ForwardGeocodingQueryRequestParameters extends ForwardGeocodingRequestParameters
{
    public function __construct(
        protected string $query,
    ) {
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'q' => $this->query,
        ]);
    }
}

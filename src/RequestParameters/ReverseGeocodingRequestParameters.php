<?php

declare(strict_types=1);

namespace Wimski\Nominatim\RequestParameters;

use Wimski\Nominatim\Contracts\RequestParameters\ReverseGeocodingRequestParametersInterface;
use Wimski\Nominatim\Objects\Coordinate;

class ReverseGeocodingRequestParameters extends AbstractGeocodingRequestParameters implements ReverseGeocodingRequestParametersInterface
{
    protected ?int $zoom = null;

    public function __construct(
        protected Coordinate $coordinate,
    ) {
    }

    public function zoom(int $zoom): self
    {
        $this->zoom = max(0, min($zoom, 18));

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'lat'  => $this->coordinate->getLatitude(),
            'lon'  => $this->coordinate->getLongitude(),
        ];

        if ($this->zoom !== null) {
            $data['zoom'] = $this->zoom;
        }

        return array_merge(parent::toArray(), $data);
    }
}

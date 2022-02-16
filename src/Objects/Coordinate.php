<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Objects;

class Coordinate
{
    public function __construct(
        protected float $latitude,
        protected float $longitude,
    ) {
        $this->latitude  = max(-90, min(90, $this->latitude));
        $this->longitude = max(-180, min(180, $this->longitude));
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Objects;

class Area
{
    public function __construct(
        protected Coordinate $topLeft,
        protected Coordinate $bottomRight,
    ) {
    }

    public function getTopLeft(): Coordinate
    {
        return $this->topLeft;
    }

    public function getBottomRight(): Coordinate
    {
        return $this->bottomRight;
    }
}

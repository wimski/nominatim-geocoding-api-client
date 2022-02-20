<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts\Responses;

use Wimski\Nominatim\Enums\OsmTypeEnum;
use Wimski\Nominatim\Objects\Address;
use Wimski\Nominatim\Objects\Area;
use Wimski\Nominatim\Objects\Coordinate;
use Wimski\Nominatim\Objects\NameDetails;
use Wimski\Nominatim\Objects\Tag;

interface GeocodingResponseItemInterface
{
    public function getPlaceId(): int;
    public function getDisplayName(): string;
    public function getLicense(): string;
    public function getCoordinate(): Coordinate;
    public function getBoundingBox(): Area;
    public function getAddress(): ?Address;
    public function getOsmId(): ?int;
    public function getOsmType(): ?OsmTypeEnum;
    public function getNameDetails(): ?NameDetails;

    /**
     * @return Tag[]
     */
    public function getExtraTags(): array;
}

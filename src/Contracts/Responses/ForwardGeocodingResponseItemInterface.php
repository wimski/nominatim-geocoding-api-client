<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Contracts\Responses;

interface ForwardGeocodingResponseItemInterface extends GeocodingResponseItemInterface
{
    public function getClass(): string;
    public function getType(): string;
    public function getImportance(): float;
    public function getIcon(): ?string;
}

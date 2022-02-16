<?php

declare(strict_types=1);

namespace Wimski\Nominatim\RequestParameters;

use Wimski\Nominatim\Contracts\RequestParametersInterface;
use Wimski\Nominatim\Enums\PolygonTypeEnum;

abstract class AbstractGeocodingRequestParameters implements RequestParametersInterface
{
    protected ?bool $includeAddressDetails;
    protected ?bool $includeNameDetails;
    protected ?bool $includeExtraTags;
    protected ?PolygonTypeEnum $polygonType;
    protected ?float $polygonThreshold;
    protected ?string $language;

    public function includeAddressDetails(bool $includeAddressDetails = true): self
    {
        $this->includeAddressDetails = $includeAddressDetails;

        return $this;
    }

    public function includeNameDetails(bool $includeNameDetails = true): self
    {
        $this->includeNameDetails = $includeNameDetails;

        return $this;
    }

    public function includeExtraTags(bool $includeExtraTags = true): self
    {
        $this->includeExtraTags = $includeExtraTags;

        return $this;
    }

    public function polygonType(PolygonTypeEnum $polygonType): self
    {
        $this->polygonType = $polygonType;

        return $this;
    }

    public function polygonThreshold(float $polygonThreshold): self
    {
        $this->polygonThreshold = $polygonThreshold;

        return $this;
    }

    public function language(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->includeAddressDetails !== null) {
            $data['addressdetails'] = (int) $this->includeAddressDetails;
        }

        if ($this->includeNameDetails !== null) {
            $data['namedetails'] = (int) $this->includeNameDetails;
        }

        if ($this->includeExtraTags !== null) {
            $data['extratags'] = (int) $this->includeExtraTags;
        }

        if ($this->polygonType) {
            /** @var string $polygonTypeKey */
            $polygonTypeKey = $this->polygonType->getValue();

            $data[$polygonTypeKey] = 1;
        }

        if ($this->polygonThreshold !== null) {
            $data['polygon_threshold'] = $this->polygonThreshold;
        }

        if ($this->language) {
            $data['accept-language'] = $this->language;
        }

        return $data;
    }
}

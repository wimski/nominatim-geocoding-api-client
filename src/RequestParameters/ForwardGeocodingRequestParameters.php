<?php

declare(strict_types=1);

namespace Wimski\Nominatim\RequestParameters;

use Wimski\Nominatim\Objects\ViewBox;

abstract class ForwardGeocodingRequestParameters extends AbstractGeocodingRequestParameters
{
    /**
     * @var string[]
     */
    protected array $countryCodes = [];

    /**
     * @var int[]|string[]
     */
    protected array $excludedPlaceIds = [];

    protected ?int $limit;
    protected ?ViewBox $viewBox;
    protected ?bool $bounded;
    protected ?bool $dedupe;

    public function addCountryCode(string $countryCode): self
    {
        $this->countryCodes[] = $countryCode;

        return $this;
    }

    public function addExcludedPlaceId(int|string $excludedPlaceId): self
    {
        $this->excludedPlaceIds[] = $excludedPlaceId;

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function viewBox(ViewBox $viewBox): self
    {
        $this->viewBox = $viewBox;

        return $this;
    }

    public function bounded(bool $bounded = true): self
    {
        $this->bounded = $bounded;

        return $this;
    }

    public function dedupe(bool $dedupe = true): self
    {
        $this->dedupe = $dedupe;

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if (! empty($this->countryCodes)) {
            $data['countrycodes'] = implode(',', $this->countryCodes);
        }

        if (! empty($this->excludedPlaceIds)) {
            $data['exclude_place_ids'] = implode(',', $this->excludedPlaceIds);
        }

        if ($this->limit) {
            $data['limit'] = $this->limit;
        }

        if ($this->viewBox) {
            $data['viewbox'] = implode(',', [
                $this->viewBox->getTopLeft()->getLongitude(),
                $this->viewBox->getTopLeft()->getLatitude(),
                $this->viewBox->getBottomRight()->getLongitude(),
                $this->viewBox->getBottomRight()->getLatitude(),
            ]);
        }

        if ($this->bounded !== null) {
            $data['bounded'] = (int) $this->bounded;
        }

        if ($this->dedupe !== null) {
            $data['dedupe'] = (int) $this->dedupe;
        }

        return array_merge(parent::toArray(), $data);
    }
}

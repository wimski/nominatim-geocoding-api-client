<?php

declare(strict_types=1);

namespace Wimski\Nominatim\RequestParameters;

use RuntimeException;

class ForwardGeocodingStructuredRequestParameters extends ForwardGeocodingRequestParameters
{
    protected ?string $street = null;
    protected ?string $city = null;
    protected ?string $county = null;
    protected ?string $state = null;
    protected ?string $country = null;
    protected ?string $postalCode = null;

    public static function make(): self
    {
        return new self();
    }

    public function street(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function city(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function county(string $county): self
    {
        $this->county = $county;

        return $this;
    }

    public function state(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function country(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function postalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * {inheritDoc}
     * @throws RuntimeException
     */
    public function toArray(): array
    {
        $data = [];

        if ($this->street) {
            $data['street'] = $this->street;
        }

        if ($this->city) {
            $data['city'] = $this->city;
        }

        if ($this->county) {
            $data['county'] = $this->county;
        }

        if ($this->state) {
            $data['state'] = $this->state;
        }

        if ($this->country) {
            $data['country'] = $this->country;
        }

        if ($this->postalCode) {
            $data['postalcode'] = $this->postalCode;
        }

        return array_merge(parent::toArray(), $data);
    }
}

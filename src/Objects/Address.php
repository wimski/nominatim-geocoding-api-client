<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Objects;

use InvalidArgumentException;
use Wimski\Nominatim\Traits\GetsOptionalArrayValue;
use Wimski\Nominatim\Traits\ValidatesArrays;

class Address
{
    use GetsOptionalArrayValue;
    use ValidatesArrays;

    protected ?string $tourism = null;
    protected ?string $office = null;
    protected ?string $street = null;
    protected ?string $houseNumber = null;
    protected ?string $postalCode = null;
    protected ?string $neighbourhood = null;
    protected ?string $suburb = null;
    protected ?string $city = null;
    protected ?string $state = null;
    protected string $country;
    protected string $countryCode;

    /**
     * @param array<string, mixed> $data
     * @throws InvalidArgumentException
     */
    public function __construct(array $data)
    {
        $this->validateArray($data, [
            'country',
            'country_code',
        ]);

        $this->tourism       = $this->getOptionalStringArrayValue($data, 'tourism');
        $this->office        = $this->getOptionalStringArrayValue($data, 'office');
        $this->street        = $this->getOptionalStringArrayValue($data, 'road');
        $this->houseNumber   = $this->getOptionalStringArrayValue($data, 'house_number');
        $this->postalCode    = $this->getOptionalStringArrayValue($data, 'postcode');
        $this->neighbourhood = $this->getOptionalStringArrayValue($data, 'neighbourhood');
        $this->suburb        = $this->getOptionalStringArrayValue($data, 'suburb');
        $this->city          = $this->getOptionalStringArrayValue($data, 'city');
        $this->state         = $this->getOptionalStringArrayValue($data, 'state');
        $this->country       = strval($data['country']);
        $this->countryCode   = strval($data['country_code']);
    }

    public function getTourism(): ?string
    {
        return $this->tourism;
    }

    public function getOffice(): ?string
    {
        return $this->office;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getNeighbourhood(): ?string
    {
        return $this->neighbourhood;
    }

    public function getSuburb(): ?string
    {
        return $this->suburb;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}

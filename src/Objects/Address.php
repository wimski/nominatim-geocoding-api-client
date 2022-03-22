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

    protected ?string $continent = null;
    protected string $country;
    protected string $countryCode;
    protected ?string $region = null;
    protected ?string $state = null;
    protected ?string $stateDistrict = null;
    protected ?string $county = null;
    protected ?string $municipality = null;
    protected ?string $city = null;
    protected ?string $town = null;
    protected ?string $village = null;
    protected ?string $cityDistrict = null;
    protected ?string $district = null;
    protected ?string $borough = null;
    protected ?string $suburb = null;
    protected ?string $subdivision = null;
    protected ?string $hamlet = null;
    protected ?string $croft = null;
    protected ?string $isolatedDwelling = null;
    protected ?string $neighbourhood = null;
    protected ?string $allotments = null;
    protected ?string $quarter = null;
    protected ?string $cityBlock = null;
    protected ?string $residential = null;
    protected ?string $farm = null;
    protected ?string $farmyard = null;
    protected ?string $industrial = null;
    protected ?string $commercial = null;
    protected ?string $retail = null;
    protected ?string $street = null;
    protected ?string $houseNumber = null;
    protected ?string $houseName = null;
    protected ?string $emergency = null;
    protected ?string $historic = null;
    protected ?string $military = null;
    protected ?string $natural = null;
    protected ?string $landUse = null;
    protected ?string $place = null;
    protected ?string $railway = null;
    protected ?string $manMade = null;
    protected ?string $aerialWay = null;
    protected ?string $boundary = null;
    protected ?string $amenity = null;
    protected ?string $aeroWay = null;
    protected ?string $club = null;
    protected ?string $craft = null;
    protected ?string $leisure = null;
    protected ?string $office = null;
    protected ?string $mountainPass = null;
    protected ?string $shop = null;
    protected ?string $tourism = null;
    protected ?string $bridge = null;
    protected ?string $tunnel = null;
    protected ?string $waterway = null;
    protected ?string $postalCode = null;

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

        $this->continent        = $this->getOptionalStringArrayValue($data, 'continent');
        $this->country          = strval($data['country']);
        $this->countryCode      = strval($data['country_code']);
        $this->region           = $this->getOptionalStringArrayValue($data, 'region');
        $this->state            = $this->getOptionalStringArrayValue($data, 'state');
        $this->stateDistrict    = $this->getOptionalStringArrayValue($data, 'state_district');
        $this->county           = $this->getOptionalStringArrayValue($data, 'county');
        $this->municipality     = $this->getOptionalStringArrayValue($data, 'municipality');
        $this->city             = $this->getOptionalStringArrayValue($data, 'city');
        $this->town             = $this->getOptionalStringArrayValue($data, 'town');
        $this->village          = $this->getOptionalStringArrayValue($data, 'village');
        $this->cityDistrict     = $this->getOptionalStringArrayValue($data, 'city_district');
        $this->district         = $this->getOptionalStringArrayValue($data, 'district');
        $this->borough          = $this->getOptionalStringArrayValue($data, 'borough');
        $this->suburb           = $this->getOptionalStringArrayValue($data, 'suburb');
        $this->subdivision      = $this->getOptionalStringArrayValue($data, 'subdivision');
        $this->hamlet           = $this->getOptionalStringArrayValue($data, 'hamlet');
        $this->croft            = $this->getOptionalStringArrayValue($data, 'croft');
        $this->isolatedDwelling = $this->getOptionalStringArrayValue($data, 'isolated_dwelling');
        $this->neighbourhood    = $this->getOptionalStringArrayValue($data, 'neighbourhood');
        $this->allotments       = $this->getOptionalStringArrayValue($data, 'allotments');
        $this->quarter          = $this->getOptionalStringArrayValue($data, 'quarter');
        $this->cityBlock        = $this->getOptionalStringArrayValue($data, 'city_block');
        $this->residential      = $this->getOptionalStringArrayValue($data, 'residental');
        $this->farm             = $this->getOptionalStringArrayValue($data, 'farm');
        $this->farmyard         = $this->getOptionalStringArrayValue($data, 'farmyard');
        $this->industrial       = $this->getOptionalStringArrayValue($data, 'industrial');
        $this->commercial       = $this->getOptionalStringArrayValue($data, 'commercial');
        $this->retail           = $this->getOptionalStringArrayValue($data, 'retail');
        $this->street           = $this->getOptionalStringArrayValue($data, 'road');
        $this->houseNumber      = $this->getOptionalStringArrayValue($data, 'house_number');
        $this->houseName        = $this->getOptionalStringArrayValue($data, 'house_name');
        $this->emergency        = $this->getOptionalStringArrayValue($data, 'emergency');
        $this->historic         = $this->getOptionalStringArrayValue($data, 'historic');
        $this->military         = $this->getOptionalStringArrayValue($data, 'military');
        $this->natural          = $this->getOptionalStringArrayValue($data, 'natural');
        $this->landUse          = $this->getOptionalStringArrayValue($data, 'landuse');
        $this->place            = $this->getOptionalStringArrayValue($data, 'place');
        $this->railway          = $this->getOptionalStringArrayValue($data, 'railway');
        $this->manMade          = $this->getOptionalStringArrayValue($data, 'man_made');
        $this->aerialWay        = $this->getOptionalStringArrayValue($data, 'aerialway');
        $this->boundary         = $this->getOptionalStringArrayValue($data, 'boundary');
        $this->amenity          = $this->getOptionalStringArrayValue($data, 'amenity');
        $this->aeroWay          = $this->getOptionalStringArrayValue($data, 'aeroway');
        $this->club             = $this->getOptionalStringArrayValue($data, 'club');
        $this->craft            = $this->getOptionalStringArrayValue($data, 'craft');
        $this->leisure          = $this->getOptionalStringArrayValue($data, 'leisure');
        $this->office           = $this->getOptionalStringArrayValue($data, 'office');
        $this->mountainPass     = $this->getOptionalStringArrayValue($data, 'mountain_pass');
        $this->shop             = $this->getOptionalStringArrayValue($data, 'shop');
        $this->tourism          = $this->getOptionalStringArrayValue($data, 'tourism');
        $this->bridge           = $this->getOptionalStringArrayValue($data, 'bridge');
        $this->tunnel           = $this->getOptionalStringArrayValue($data, 'tunnel');
        $this->waterway         = $this->getOptionalStringArrayValue($data, 'waterway');
        $this->postalCode       = $this->getOptionalStringArrayValue($data, 'postcode');
    }

    public function getContinent(): ?string
    {
        return $this->continent;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getStateDistrict(): ?string
    {
        return $this->stateDistrict;
    }

    public function getCounty(): ?string
    {
        return $this->county;
    }

    public function getMunicipality(): ?string
    {
        return $this->municipality;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function getVillage(): ?string
    {
        return $this->village;
    }

    public function getCityDistrict(): ?string
    {
        return $this->cityDistrict;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getBorough(): ?string
    {
        return $this->borough;
    }

    public function getSuburb(): ?string
    {
        return $this->suburb;
    }

    public function getSubdivision(): ?string
    {
        return $this->subdivision;
    }

    public function getHamlet(): ?string
    {
        return $this->hamlet;
    }

    public function getCroft(): ?string
    {
        return $this->croft;
    }

    public function getIsolatedDwelling(): ?string
    {
        return $this->isolatedDwelling;
    }

    public function getNeighbourhood(): ?string
    {
        return $this->neighbourhood;
    }

    public function getAllotments(): ?string
    {
        return $this->allotments;
    }

    public function getQuarter(): ?string
    {
        return $this->quarter;
    }

    public function getCityBlock(): ?string
    {
        return $this->cityBlock;
    }

    public function getResidential(): ?string
    {
        return $this->residential;
    }

    public function getFarm(): ?string
    {
        return $this->farm;
    }

    public function getFarmyard(): ?string
    {
        return $this->farmyard;
    }

    public function getIndustrial(): ?string
    {
        return $this->industrial;
    }

    public function getCommercial(): ?string
    {
        return $this->commercial;
    }

    public function getRetail(): ?string
    {
        return $this->retail;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function getHouseName(): ?string
    {
        return $this->houseName;
    }

    public function getEmergency(): ?string
    {
        return $this->emergency;
    }

    public function getHistoric(): ?string
    {
        return $this->historic;
    }

    public function getMilitary(): ?string
    {
        return $this->military;
    }

    public function getNatural(): ?string
    {
        return $this->natural;
    }

    public function getLandUse(): ?string
    {
        return $this->landUse;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function getRailway(): ?string
    {
        return $this->railway;
    }

    public function getManMade(): ?string
    {
        return $this->manMade;
    }

    public function getAerialWay(): ?string
    {
        return $this->aerialWay;
    }

    public function getBoundary(): ?string
    {
        return $this->boundary;
    }

    public function getAmenity(): ?string
    {
        return $this->amenity;
    }

    public function getAeroWay(): ?string
    {
        return $this->aeroWay;
    }

    public function getClub(): ?string
    {
        return $this->club;
    }

    public function getCraft(): ?string
    {
        return $this->craft;
    }

    public function getLeisure(): ?string
    {
        return $this->leisure;
    }

    public function getOffice(): ?string
    {
        return $this->office;
    }

    public function getMountainPass(): ?string
    {
        return $this->mountainPass;
    }

    public function getShop(): ?string
    {
        return $this->shop;
    }

    public function getTourism(): ?string
    {
        return $this->tourism;
    }

    public function getBridge(): ?string
    {
        return $this->bridge;
    }

    public function getTunnel(): ?string
    {
        return $this->tunnel;
    }

    public function getWaterway(): ?string
    {
        return $this->waterway;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }
}

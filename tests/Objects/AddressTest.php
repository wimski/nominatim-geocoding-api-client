<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Objects;

use InvalidArgumentException;
use Wimski\Nominatim\Objects\Address;
use Wimski\Nominatim\Tests\AbstractTest;

class AddressTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_set_data(): void
    {
        $address = new Address([
            'continent'         => 'lorem',
            'country'           => 'ipsum',
            'country_code'      => 'dolor',
            'region'            => 'sit',
            'state'             => 'amet',
            'state_district'    => 'consectetur',
            'county'            => 'adipiscing',
            'municipality'      => 'elit',
            'city'              => 'sed',
            'town'              => 'do',
            'village'           => 'eiusmod',
            'city_district'     => 'tempor',
            'district'          => 'incididunt',
            'borough'           => 'ut',
            'suburb'            => 'labore',
            'subdivision'       => 'et',
            'hamlet'            => 'dolore',
            'croft'             => 'magna',
            'isolated_dwelling' => 'aliqua',
            'neighbourhood'     => 'ut',
            'allotments'        => 'enim',
            'quarter'           => 'ad',
            'city_block'        => 'minim',
            'residental'        => 'veniam',
            'farm'              => 'quis',
            'farmyard'          => 'nostrud',
            'industrial'        => 'exercitation',
            'commercial'        => 'ullamco',
            'retail'            => 'laboris',
            'road'              => 'nisi',
            'house_number'      => 'ut',
            'house_name'        => 'aliquip',
            'emergency'         => 'ex',
            'historic'          => 'ea',
            'military'          => 'commodo',
            'natural'           => 'consequat',
            'landuse'           => 'duis',
            'place'             => 'autre',
            'railway'           => 'irure',
            'man_made'          => 'dolor',
            'aerialway'         => 'in',
            'boundary'          => 'reprehenderit',
            'amenity'           => 'in',
            'aeroway'           => 'voluptate',
            'club'              => 'velit',
            'craft'             => 'esse',
            'leisure'           => 'cillum',
            'office'            => 'dolore',
            'mountain_pass'     => 'eu',
            'shop'              => 'fugiat',
            'tourism'           => 'nulla',
            'bridge'            => 'pariatur',
            'tunnel'            => 'excepteur',
            'waterway'          => 'sint',
            'postcode'          => 'occaecat',
        ]);

        static::assertSame('lorem', $address->getContinent());
        static::assertSame('ipsum', $address->getCountry());
        static::assertSame('dolor', $address->getCountryCode());
        static::assertSame('sit', $address->getRegion());
        static::assertSame('amet', $address->getState());
        static::assertSame('consectetur', $address->getStateDistrict());
        static::assertSame('adipiscing', $address->getCounty());
        static::assertSame('elit', $address->getMunicipality());
        static::assertSame('sed', $address->getCity());
        static::assertSame('do', $address->getTown());
        static::assertSame('eiusmod', $address->getVillage());
        static::assertSame('tempor', $address->getCityDistrict());
        static::assertSame('incididunt', $address->getDistrict());
        static::assertSame('ut', $address->getBorough());
        static::assertSame('labore', $address->getSuburb());
        static::assertSame('et', $address->getSubdivision());
        static::assertSame('dolore', $address->getHamlet());
        static::assertSame('magna', $address->getCroft());
        static::assertSame('aliqua', $address->getIsolatedDwelling());
        static::assertSame('ut', $address->getNeighbourhood());
        static::assertSame('enim', $address->getAllotments());
        static::assertSame('ad', $address->getQuarter());
        static::assertSame('minim', $address->getCityBlock());
        static::assertSame('veniam', $address->getResidential());
        static::assertSame('quis', $address->getFarm());
        static::assertSame('nostrud', $address->getFarmyard());
        static::assertSame('exercitation', $address->getIndustrial());
        static::assertSame('ullamco', $address->getCommercial());
        static::assertSame('laboris', $address->getRetail());
        static::assertSame('nisi', $address->getStreet());
        static::assertSame('ut', $address->getHouseNumber());
        static::assertSame('aliquip', $address->getHouseName());
        static::assertSame('ex', $address->getEmergency());
        static::assertSame('ea', $address->getHistoric());
        static::assertSame('commodo', $address->getMilitary());
        static::assertSame('consequat', $address->getNatural());
        static::assertSame('duis', $address->getLandUse());
        static::assertSame('autre', $address->getPlace());
        static::assertSame('irure', $address->getRailway());
        static::assertSame('dolor', $address->getManMade());
        static::assertSame('in', $address->getAerialWay());
        static::assertSame('reprehenderit', $address->getBoundary());
        static::assertSame('in', $address->getAmenity());
        static::assertSame('voluptate', $address->getAeroWay());
        static::assertSame('velit', $address->getClub());
        static::assertSame('esse', $address->getCraft());
        static::assertSame('cillum', $address->getLeisure());
        static::assertSame('dolore', $address->getOffice());
        static::assertSame('eu', $address->getMountainPass());
        static::assertSame('fugiat', $address->getShop());
        static::assertSame('nulla', $address->getTourism());
        static::assertSame('pariatur', $address->getBridge());
        static::assertSame('excepteur', $address->getTunnel());
        static::assertSame('sint', $address->getWaterway());
        static::assertSame('occaecat', $address->getPostalCode());

    }

    /**
     * @test
     */
    public function it_accepts_incomplete_data(): void
    {
        $address = new Address([
            'country'      => 'Land',
            'country_code' => 'xx',
        ]);

        static::assertNull($address->getContinent());
        static::assertNull($address->getRegion());
        static::assertNull($address->getState());
        static::assertNull($address->getStateDistrict());
        static::assertNull($address->getCounty());
        static::assertNull($address->getMunicipality());
        static::assertNull($address->getCity());
        static::assertNull($address->getTown());
        static::assertNull($address->getVillage());
        static::assertNull($address->getCityDistrict());
        static::assertNull($address->getDistrict());
        static::assertNull($address->getBorough());
        static::assertNull($address->getSuburb());
        static::assertNull($address->getSubdivision());
        static::assertNull($address->getHamlet());
        static::assertNull($address->getCroft());
        static::assertNull($address->getIsolatedDwelling());
        static::assertNull($address->getNeighbourhood());
        static::assertNull($address->getAllotments());
        static::assertNull($address->getQuarter());
        static::assertNull($address->getCityBlock());
        static::assertNull($address->getResidential());
        static::assertNull($address->getFarm());
        static::assertNull($address->getFarmyard());
        static::assertNull($address->getIndustrial());
        static::assertNull($address->getCommercial());
        static::assertNull($address->getRetail());
        static::assertNull($address->getStreet());
        static::assertNull($address->getHouseNumber());
        static::assertNull($address->getHouseName());
        static::assertNull($address->getEmergency());
        static::assertNull($address->getHistoric());
        static::assertNull($address->getMilitary());
        static::assertNull($address->getNatural());
        static::assertNull($address->getLandUse());
        static::assertNull($address->getPlace());
        static::assertNull($address->getRailway());
        static::assertNull($address->getManMade());
        static::assertNull($address->getAerialWay());
        static::assertNull($address->getBoundary());
        static::assertNull($address->getAmenity());
        static::assertNull($address->getAeroWay());
        static::assertNull($address->getClub());
        static::assertNull($address->getCraft());
        static::assertNull($address->getLeisure());
        static::assertNull($address->getOffice());
        static::assertNull($address->getMountainPass());
        static::assertNull($address->getShop());
        static::assertNull($address->getTourism());
        static::assertNull($address->getBridge());
        static::assertNull($address->getTunnel());
        static::assertNull($address->getWaterway());
        static::assertNull($address->getPostalCode());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_country_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'country' in array");

        new Address([]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_country_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'country' cannot be null");

        new Address([
            'country' => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_country_code_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'country_code' in array");

        new Address([
            'country' => 'Land',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_country_code_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'country_code' cannot be null");

        new Address([
            'country'      => 'Land',
            'country_code' => null,
        ]);
    }
}

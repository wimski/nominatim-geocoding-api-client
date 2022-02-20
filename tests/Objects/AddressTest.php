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
            'tourism'       => 'Landmark',
            'office'        => 'Corner',
            'road'          => 'Street',
            'house_number'  => '123',
            'postcode'      => '0000XY',
            'neighbourhood' => 'Community',
            'suburb'        => 'Zone',
            'city'          => 'Place',
            'state'         => 'Province',
            'country'       => 'Land',
            'country_code'  => 'xx',
        ]);

        static::assertSame('Landmark', $address->getTourism());
        static::assertSame('Corner', $address->getOffice());
        static::assertSame('Street', $address->getStreet());
        static::assertSame('123', $address->getHouseNumber());
        static::assertSame('0000XY', $address->getPostalCode());
        static::assertSame('Community', $address->getNeighbourhood());
        static::assertSame('Zone', $address->getSuburb());
        static::assertSame('Place', $address->getCity());
        static::assertSame('Province', $address->getState());
        static::assertSame('Land', $address->getCountry());
        static::assertSame('xx', $address->getCountryCode());
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

        static::assertNull($address->getTourism());
        static::assertNull($address->getOffice());
        static::assertNull($address->getStreet());
        static::assertNull($address->getHouseNumber());
        static::assertNull($address->getPostalCode());
        static::assertNull($address->getNeighbourhood());
        static::assertNull($address->getSuburb());
        static::assertNull($address->getCity());
        static::assertNull($address->getState());
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

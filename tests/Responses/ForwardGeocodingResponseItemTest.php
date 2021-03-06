<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Responses;

use InvalidArgumentException;
use Wimski\Nominatim\Enums\OsmTypeEnum;
use Wimski\Nominatim\Objects\Address;
use Wimski\Nominatim\Objects\NameDetails;
use Wimski\Nominatim\Responses\ForwardGeocodingResponseItem;
use Wimski\Nominatim\Tests\AbstractTest;

class ForwardGeocodingResponseItemTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_extracts_and_returns_data(): void
    {
        $response = new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'osm_type'     => 'node',
            'osm_id'       => 67890,
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => ['52.0', '53.0', '5.0', '6.0'],
            'address'      => [
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
            ],
            'namedetails'  => [
                'name'    => 'Beautiful Building',
                'name:en' => 'English',
                'name:nl' => 'Dutch',
            ],
            'extratags'    => [
                'foo'   => 'bar',
                'lorem' => 'ipsum',
            ],
            'class'        => 'object',
            'type'         => 'thing',
            'importance'   => 0.25,
            'icon'         => 'icon.svg',
        ]);

        static::assertSame(12345, $response->getPlaceId());
        static::assertSame('Beautiful Building', $response->getDisplayName());
        static::assertSame('MIT', $response->getLicense());
        static::assertTrue(OsmTypeEnum::NODE()->equals($response->getOsmType()));
        static::assertSame(67890, $response->getOsmId());
        static::assertSame(52.1009274, $response->getCoordinate()->getLatitude());
        static::assertSame(5.644109, $response->getCoordinate()->getLongitude());
        static::assertSame(52.0, $response->getBoundingBox()->getTopLeft()->getLatitude());
        static::assertSame(5.0, $response->getBoundingBox()->getTopLeft()->getLongitude());
        static::assertSame(53.0, $response->getBoundingBox()->getBottomRight()->getLatitude());
        static::assertSame(6.0, $response->getBoundingBox()->getBottomRight()->getLongitude());
        static::assertSame('object', $response->getClass());
        static::assertSame('thing', $response->getType());
        static::assertSame(0.25, $response->getImportance());
        static::assertSame('icon.svg', $response->getIcon());

        /** @var Address $address */
        $address = $response->getAddress();
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

        /** @var NameDetails $nameDetails */
        $nameDetails = $response->getNameDetails();
        static::assertSame('Beautiful Building', $nameDetails->getName());
        static::assertSame('English', $nameDetails->getTranslatedName('en'));
        static::assertSame('Dutch', $nameDetails->getTranslatedName('nl'));

        static::assertCount(2, $response->getExtraTags());
        static::assertSame('foo', $response->getExtraTags()[0]->getName());
        static::assertSame('bar', $response->getExtraTags()[0]->getValue());
        static::assertSame('lorem', $response->getExtraTags()[1]->getName());
        static::assertSame('ipsum', $response->getExtraTags()[1]->getValue());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_place_id_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'place_id' in array");

        new ForwardGeocodingResponseItem([]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_place_id_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'place_id' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id' => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_display_name_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'display_name' in array");

        new ForwardGeocodingResponseItem([
            'place_id' => 12345,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_display_name_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'display_name' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_lat_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'lat' in array");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_lat_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'lat' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_lon_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'lon' in array");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_lon_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'lon' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_boundingbox_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'boundingbox' in array");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_boundingbox_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'boundingbox' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_class_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'class' in array");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => ['52.0', '53.0', '5.0', '6.0'],
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_class_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'class' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => ['52.0', '53.0', '5.0', '6.0'],
            'class'        => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_type_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'type' in array");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => ['52.0', '53.0', '5.0', '6.0'],
            'class'        => 'object',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_type_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'type' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => ['52.0', '53.0', '5.0', '6.0'],
            'class'        => 'object',
            'type'         => null,
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_importance_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'importance' in array");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => ['52.0', '53.0', '5.0', '6.0'],
            'class'        => 'object',
            'type'         => 'thing',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_importance_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'importance' cannot be null");

        new ForwardGeocodingResponseItem([
            'place_id'     => 12345,
            'display_name' => 'Beautiful Building',
            'license'      => 'MIT',
            'lat'          => '52.1009274',
            'lon'          => '5.644109',
            'boundingbox'  => ['52.0', '53.0', '5.0', '6.0'],
            'class'        => 'object',
            'type'         => 'thing',
            'importance'   => null,
        ]);
    }
}

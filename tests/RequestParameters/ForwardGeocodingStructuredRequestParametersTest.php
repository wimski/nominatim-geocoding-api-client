<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\RequestParameters;

use PHPUnit\Framework\TestCase;
use Wimski\Nominatim\Enums\PolygonTypeEnum;
use Wimski\Nominatim\Objects\Area;
use Wimski\Nominatim\Objects\Coordinate;
use Wimski\Nominatim\RequestParameters\ForwardGeocodingStructuredRequestParameters;

class ForwardGeocodingStructuredRequestParametersTest extends TestCase
{
    protected ForwardGeocodingStructuredRequestParameters $parameters;

    protected function setUp(): void
    {
        parent::setUp();

        $this->parameters = new ForwardGeocodingStructuredRequestParameters();
    }

    /**
     * @test
     */
    public function it_converts_to_an_array(): void
    {
        static::assertSame([], $this->parameters->toArray());
    }

    /**
     * @test
     * @depends it_converts_to_an_array
     */
    public function it_includes_structured_fields_if_available(): void
    {
        $this->parameters
            ->street('Road')
            ->city('Place')
            ->county('Shire')
            ->state('Province')
            ->country('Land')
            ->postalCode('xxx');

        static::assertSame([
            'street'     => 'Road',
            'city'       => 'Place',
            'county'     => 'Shire',
            'state'      => 'Province',
            'country'    => 'Land',
            'postalcode' => 'xxx',
        ], $this->parameters->toArray());
    }

    /**
     * @test
     * @depends it_converts_to_an_array
     */
    public function it_includes_forward_geocoding_fields_if_available(): void
    {
        $this->parameters
            ->addCountryCode('nl')
            ->addCountryCode('be')
            ->addExcludedPlaceId(123)
            ->addExcludedPlaceId('abc')
            ->limit(25)
            ->viewBox(new Area(
                new Coordinate(1.1, 2.2),
                new Coordinate(3.3, 4.4),
            ))
            ->bounded()
            ->dedupe();

        static::assertSame([
            'countrycodes'      => 'nl,be',
            'exclude_place_ids' => '123,abc',
            'limit'             => 25,
            'viewbox'           => '2.2,1.1,4.4,3.3',
            'bounded'           => 1,
            'dedupe'            => 1,
        ], $this->parameters->toArray());
    }

    /**
     * @test
     * @depends it_converts_to_an_array
     */
    public function it_includes_general_fields_if_available(): void
    {
        $this->parameters
            ->includeAddressDetails()
            ->includeNameDetails()
            ->includeExtraTags()
            ->polygonType(PolygonTypeEnum::GEO_JSON())
            ->polygonThreshold(5.2)
            ->language('ru');

        static::assertSame([
            'addressdetails'    => 1,
            'namedetails'       => 1,
            'extratags'         => 1,
            'polygon_geojson'   => 1,
            'polygon_threshold' => 5.2,
            'accept-language'   => 'ru',
        ], $this->parameters->toArray());
    }
}

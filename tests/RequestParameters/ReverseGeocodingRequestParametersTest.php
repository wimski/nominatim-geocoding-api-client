<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\RequestParameters;

use Wimski\Nominatim\Enums\PolygonTypeEnum;
use Wimski\Nominatim\Objects\Coordinate;
use Wimski\Nominatim\RequestParameters\ReverseGeocodingRequestParameters;
use Wimski\Nominatim\Tests\AbstractTest;

class ReverseGeocodingRequestParametersTest extends AbstractTest
{
    protected ReverseGeocodingRequestParameters $parameters;

    protected function setUp(): void
    {
        parent::setUp();

        $this->parameters = new ReverseGeocodingRequestParameters(
            new Coordinate(52.1009274, 5.644109),
        );
    }

    /**
     * @test
     */
    public function it_converts_to_an_array(): void
    {
        static::assertSame([
            'lat' => 52.1009274,
            'lon' => 5.644109,
        ], $this->parameters->toArray());
    }

    /**
     * @test
     * @depends it_converts_to_an_array
     */
    public function it_includes_the_zoom_if_available(): void
    {
        $this->parameters->zoom(5);

        static::assertSame([
            'lat'  => 52.1009274,
            'lon'  => 5.644109,
            'zoom' => 5,
        ], $this->parameters->toArray());
    }

    /**
     * @test
     * @depends it_includes_the_zoom_if_available
     * @dataProvider limitedZoomDataProvider
     */
    public function it_limits_the_zoom(int $input, int $result): void
    {
        $this->parameters->zoom($input);

        static::assertSame([
            'lat'  => 52.1009274,
            'lon'  => 5.644109,
            'zoom' => $result,
        ], $this->parameters->toArray());
    }

    /**
     * @return int[][]
     */
    public function limitedZoomDataProvider(): array
    {
        return [
            [-10, 0],
            [20, 18],
        ];
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
            'lat'               => 52.1009274,
            'lon'               => 5.644109,
        ], $this->parameters->toArray());
    }
}

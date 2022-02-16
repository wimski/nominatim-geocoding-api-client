<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Objects;

use Wimski\Nominatim\Objects\Coordinate;
use Wimski\Nominatim\Tests\AbstractTest;

class CoordinateTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_the_set_data(): void
    {
        $coordinate = new Coordinate(52.1009274, 5.644109);

        static::assertSame(52.1009274, $coordinate->getLatitude());
        static::assertSame(5.644109, $coordinate->getLongitude());
    }

    /**
     * @test
     * @depends it_returns_the_set_data
     * @dataProvider limitedLatitudeDataProvider
     */
    public function it_limits_the_latitude(float $input, float $result): void
    {
        $coordinate = new Coordinate($input, 0.0);

        static::assertSame($result, $coordinate->getLatitude());
    }

    /**
     * @return float[][]
     */
    public function limitedLatitudeDataProvider(): array
    {
        return [
            [-100.0, -90.0],
            [100.0, 90.0],
        ];
    }

    /**
     * @test
     * @depends it_returns_the_set_data
     * @dataProvider limitedLongitudeDataProvider
     */
    public function it_limits_the_longitude(float $input, float $result): void
    {
        $coordinate = new Coordinate(0.0, $input);

        static::assertSame($result, $coordinate->getLongitude());
    }

    /**
     * @return float[][]
     */
    public function limitedLongitudeDataProvider(): array
    {
        return [
            [-200.0, -180.0],
            [200.0, 180.0],
        ];
    }
}

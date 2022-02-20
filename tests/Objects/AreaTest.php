<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Objects;

use Mockery;
use Wimski\Nominatim\Objects\Area;
use Wimski\Nominatim\Objects\Coordinate;
use Wimski\Nominatim\Tests\AbstractTest;

class AreaTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_the_set_data(): void
    {
        $topLeft     = Mockery::mock(Coordinate::class);
        $bottomRight = Mockery::mock(Coordinate::class);

        $area = new Area($topLeft, $bottomRight);

        static::assertSame($topLeft, $area->getTopLeft());
        static::assertSame($bottomRight, $area->getBottomRight());
    }
}

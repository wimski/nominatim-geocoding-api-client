<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Objects;

use Mockery;
use Wimski\Nominatim\Objects\Coordinate;
use Wimski\Nominatim\Objects\ViewBox;
use Wimski\Nominatim\Tests\AbstractTest;

class ViewBoxTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_the_set_data(): void
    {
        $topLeft     = Mockery::mock(Coordinate::class);
        $bottomRight = Mockery::mock(Coordinate::class);

        $viewBox = new ViewBox($topLeft, $bottomRight);

        static::assertSame($topLeft, $viewBox->getTopLeft());
        static::assertSame($bottomRight, $viewBox->getBottomRight());
    }
}

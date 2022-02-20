<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Responses;

use Wimski\Nominatim\Responses\ForwardGeocodingResponse;
use Wimski\Nominatim\Tests\AbstractTest;
use Wimski\Nominatim\Tests\Traits\MocksResponse;

class ForwardGeocodingResponseTest extends AbstractTest
{
    use MocksResponse;

    /**
     * @test
     */
    public function it_returns_items(): void
    {
        $response = new ForwardGeocodingResponse($this->mockResponse('[
            {
                "place_id": 12345,
                "display_name": "Beautiful Building",
                "license": "MIT",
                "lat": "52.1009274",
                "lon": "5.644109",
                "boundingbox": ["52.0", "53.0", "5.0", "6.0"],
                "class": "object",
                "type": "thing",
                "importance": 0.25
            },
            {
                "place_id": 67890,
                "display_name": "Statue of Something",
                "license": "MIT",
                "lat": "52.1009274",
                "lon": "5.644109",
                "boundingbox": ["52.0", "53.0", "5.0", "6.0"],
                "class": "other",
                "type": "statue",
                "importance": 0.33
            }
        ]'));

        static::assertCount(2, $response->getItems());
        static::assertSame(12345, $response->getItems()[0]->getPlaceId());
        static::assertSame(67890, $response->getItems()[1]->getPlaceId());
    }
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Transformers;

use Wimski\Nominatim\Exceptions\ResponseException;
use Wimski\Nominatim\Responses\ForwardGeocodingResponse;
use Wimski\Nominatim\Responses\ReverseGeocodingResponse;
use Wimski\Nominatim\Tests\AbstractTest;
use Wimski\Nominatim\Tests\Traits\MocksResponse;
use Wimski\Nominatim\Transformers\GeocodingResponseTransformer;

class GeocodingResponseTransformerTest extends AbstractTest
{
    use MocksResponse;

    protected GeocodingResponseTransformer $transformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new GeocodingResponseTransformer();
    }

    /**
     * @test
     */
    public function it_transforms_a_forward_response(): void
    {
        $response = $this->transformer->transformForwardResponse($this->mockResponse('[]'));

        static::assertInstanceOf(ForwardGeocodingResponse::class, $response);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_transforming_forward_response_fails(): void
    {
        static::expectException(ResponseException::class);

        $this->transformer->transformForwardResponse($this->mockResponse('foo'));
    }

    /**
     * @test
     */
    public function it_transforms_a_reverse_response(): void
    {
        $response = $this->transformer->transformReverseResponse($this->mockResponse('{
            "place_id": 12345,
            "display_name": "Beautiful Building",
            "license": "MIT",
            "lat": "52.1009274",
            "lon": "5.644109",
            "boundingbox": ["52.0", "53.0", "5.0", "6.0"]
        }'));

        static::assertInstanceOf(ReverseGeocodingResponse::class, $response);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_transforming_reverse_response_fails(): void
    {
        static::expectException(ResponseException::class);

        $this->transformer->transformReverseResponse($this->mockResponse('foo'));
    }
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Config;

use Wimski\Nominatim\Config\LocationIqConfig;
use Wimski\Nominatim\Tests\AbstractTest;

class LocationIqConfigTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_set_data(): void
    {
        $config = new LocationIqConfig(
            'access-token',
            'https://nominatim.myserver.com',
            '/fowarding',
            '/reversing',
            'nl',
        );

        static::assertSame('access-token', $config->getKey());
        static::assertSame('https://nominatim.myserver.com', $config->getUrl());
        static::assertSame('/fowarding', $config->getForwardGeocodingEndpoint());
        static::assertSame('/reversing', $config->getReverseGeocodingEndpoint());
        static::assertSame('nl', $config->getLanguage());
    }

    /**
     * @test
     */
    public function it_returns_default_data(): void
    {
        $config = new LocationIqConfig(
            'access-token',
        );

        static::assertSame('https://eu1.locationiq.com/v1', $config->getUrl());
        static::assertSame('search.php', $config->getForwardGeocodingEndpoint());
        static::assertSame('reverse.php', $config->getReverseGeocodingEndpoint());
        static::assertSame('en-US', $config->getLanguage());
    }
}

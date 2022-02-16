<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Config;

use PHPUnit\Framework\TestCase;
use Wimski\Nominatim\Config\NominatimConfig;

class NominatimConfigTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_set_data(): void
    {
        $config = new NominatimConfig(
            'my-app-identifier',
            'email@host.com',
            'https://nominatim.myserver.com',
            '/fowarding',
            '/reversing',
            'nl',
        );

        static::assertSame('my-app-identifier', $config->getUserAgent());
        static::assertSame('email@host.com', $config->getEmail());
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
        $config = new NominatimConfig(
            'my-app-identifier',
            'email@host.com',
        );

        static::assertSame('https://nominatim.openstreetmap.org', $config->getUrl());
        static::assertSame('search', $config->getForwardGeocodingEndpoint());
        static::assertSame('reverse', $config->getReverseGeocodingEndpoint());
        static::assertSame('en-US', $config->getLanguage());
    }
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Config;

use Wimski\Nominatim\Config\GenericConfig;
use Wimski\Nominatim\Tests\AbstractTest;

class GenericConfigTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_set_data(): void
    {
        $config = new GenericConfig(
            'https://nominatim.myserver.com',
            '/fowarding',
            '/reversing',
            'nl',
        );

        static::assertSame('https://nominatim.myserver.com', $config->getUrl());
        static::assertSame('/fowarding', $config->getForwardGeocodingEndpoint());
        static::assertSame('/reversing', $config->getReverseGeocodingEndpoint());
        static::assertSame('nl', $config->getLanguage());
    }
}

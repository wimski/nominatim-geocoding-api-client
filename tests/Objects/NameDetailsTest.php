<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Objects;

use InvalidArgumentException;
use Wimski\Nominatim\Objects\NameDetails;
use Wimski\Nominatim\Tests\AbstractTest;

class NameDetailsTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_set_data(): void
    {
        $nameDetails = new NameDetails([
            'name'    => 'Lorem',
            'name:en' => 'Ipsum',
            'name:nl' => 'Dolor',
        ]);

        static::assertSame('Lorem', $nameDetails->getName());
        static::assertSame('Ipsum', $nameDetails->getTranslatedName('en'));
        static::assertSame('Dolor', $nameDetails->getTranslatedName('nl'));
    }

    /**
     * @test
     */
    public function it_does_not_extract_translated_names_with_incorrectly_formatted_keys(): void
    {
        $nameDetails = new NameDetails([
            'name'    => '',
            'en'      => 'Foo',
            'name.nl' => 'Bar',
            'de:name' => 'Thing',
        ]);

        static::assertNull($nameDetails->getTranslatedName('en'));
        static::assertNull($nameDetails->getTranslatedName('nl'));
        static::assertNull($nameDetails->getTranslatedName('de'));
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_name_is_missing(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Missing key 'name' in array");

        new NameDetails([]);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_the_name_is_null(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage("Key 'name' cannot be null");

        new NameDetails([
            'name' => null,
        ]);
    }
}

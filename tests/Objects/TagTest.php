<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests\Objects;

use Wimski\Nominatim\Objects\Tag;
use Wimski\Nominatim\Tests\AbstractTest;

class TagTest extends AbstractTest
{
    /**
     * @test
     */
    public function it_returns_set_data(): void
    {
        $tag = new Tag('foo', 'bar');

        static::assertSame('foo', $tag->getName());
        static::assertSame('bar', $tag->getValue());
    }
}

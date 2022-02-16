<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    use MockeryPHPUnitIntegration;
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Enums;

use MyCLabs\Enum\Enum;

/**
 * @extends Enum<string>
 * @method static static NODE()
 * @method static static RELATION()
 * @method static static WAY()
 */
class OsmTypeEnum extends Enum
{
    public const NODE     = 'node';
    public const RELATION = 'relation';
    public const WAY      = 'way';
}

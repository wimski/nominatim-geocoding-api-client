<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Enums;

use MyCLabs\Enum\Enum;

/**
 * @extends Enum<string>
 * @method static static GEO_JSON()
 * @method static static KML()
 * @method static static SVG()
 * @method static static TEXT()
 */
class PolygonTypeEnum extends Enum
{
    public const GEO_JSON = 'polygon_geojson';
    public const KML      = 'polygon_kml';
    public const SVG      = 'polygon_svg';
    public const TEXT     = 'polygon_text';
}

<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Responses;

use InvalidArgumentException;
use Wimski\Nominatim\Contracts\Responses\GeocodingResponseItemInterface;
use Wimski\Nominatim\Enums\OsmTypeEnum;
use Wimski\Nominatim\Objects\Address;
use Wimski\Nominatim\Objects\Area;
use Wimski\Nominatim\Objects\Coordinate;
use Wimski\Nominatim\Objects\NameDetails;
use Wimski\Nominatim\Objects\Tag;
use Wimski\Nominatim\Traits\GetsOptionalArrayValue;
use Wimski\Nominatim\Traits\ValidatesArrays;

abstract class AbstractGeocodingResponseItem implements GeocodingResponseItemInterface
{
    use GetsOptionalArrayValue;
    use ValidatesArrays;

    protected int $placeId;
    protected string $displayName;
    protected string $license;
    protected Coordinate $coordinate;
    protected Area $boundingBox;
    protected ?Address $address = null;
    protected ?int $osmId = null;
    protected ?OsmTypeEnum $osmType = null;
    protected ?NameDetails $nameDetails = null;

    /**
     * @var Tag[]
     */
    protected array $extraTags = [];

    public function getPlaceId(): int
    {
        return $this->placeId;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getLicense(): string
    {
        return $this->license;
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function getBoundingBox(): Area
    {
        return $this->boundingBox;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getOsmId(): ?int
    {
        return $this->osmId;
    }

    public function getOsmType(): ?OsmTypeEnum
    {
        return $this->osmType;
    }

    public function getNameDetails(): ?NameDetails
    {
        return $this->nameDetails;
    }

    public function getExtraTags(): array
    {
        return $this->extraTags;
    }

    /**
     * @param array<string, mixed> $data
     * @throws InvalidArgumentException
     */
    protected function validate(array $data): void
    {
        $this->validateArray($data, [
            'place_id',
            'display_name',
            'license',
            'lat',
            'lon',
            'boundingbox',
        ]);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extract(array $data): void
    {
        $this->extractScalarValues($data);
        $this->extractCoordinate($data);
        $this->extractBoundingBox($data);
        $this->extractAddress($data);
        $this->extractOsmType($data);
        $this->extractNameDetails($data);
        $this->extractExtraTags($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractScalarValues(array $data): void
    {
        $this->placeId     = intval($data['place_id']);
        $this->displayName = strval($data['display_name']);
        $this->license     = strval($data['license']);
        $this->osmId       = $this->getOptionalIntegerArrayValue($data, 'osm_id');
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractCoordinate(array $data): void
    {
        $this->coordinate  = new Coordinate(
            floatval($data['lat']),
            floatval($data['lon']),
        );
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractBoundingBox(array $data): void
    {
        /** @var string[] $boundingBox */
        $boundingBox = $data['boundingbox'];

        $this->boundingBox = new Area(
            new Coordinate(
                floatval($boundingBox[0]),
                floatval($boundingBox[2]),
            ),
            new Coordinate(
                floatval($boundingBox[1]),
                floatval($boundingBox[3]),
            ),
        );
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractAddress(array $data): void
    {
        /** @var array<string, string>|null $address */
        $address = $this->getOptionalArrayValue($data, 'address');

        if (! $address) {
            return;
        }

        $this->address = new Address($address);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractOsmType(array $data): void
    {
        $osmType = $this->getOptionalStringArrayValue($data, 'osm_type');

        if (! $osmType) {
            return;
        }

        $this->osmType = OsmTypeEnum::from($osmType);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractNameDetails(array $data): void
    {
        /** @var array<string, string>|null $nameDetails */
        $nameDetails = $this->getOptionalArrayValue($data, 'namedetails');

        if (empty($nameDetails)) {
            return;
        }

        $this->nameDetails = new NameDetails($nameDetails);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractExtraTags(array $data): void
    {
        /** @var array<string, string>|null $extraTags */
        $extraTags = $this->getOptionalArrayValue($data, 'extratags');

        if (empty($extraTags)) {
            return;
        }

        foreach ($extraTags as $name => $value) {
            $this->extraTags[] = new Tag($name, $value);
        }
    }
}

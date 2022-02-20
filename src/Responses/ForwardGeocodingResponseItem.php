<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Responses;

use InvalidArgumentException;
use Wimski\Nominatim\Contracts\Responses\ForwardGeocodingResponseItemInterface;

class ForwardGeocodingResponseItem extends AbstractGeocodingResponseItem implements ForwardGeocodingResponseItemInterface
{
    protected string $class;
    protected string $type;
    protected float $importance;
    protected ?string $icon;

    /**
     * @param array<string, mixed> $data
     * @throws InvalidArgumentException
     */
    public function __construct(array $data)
    {
        $this->validate($data);
        $this->extract($data);
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getImportance(): float
    {
        return $this->importance;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    protected function validate(array $data): void
    {
        parent::validate($data);

        $this->validateArray($data, [
            'class',
            'type',
            'importance',
        ]);
    }

    protected function extractScalarValues(array $data): void
    {
        parent::extractScalarValues($data);

        $this->class      = strval($data['class']);
        $this->type       = strval($data['type']);
        $this->importance = floatval($data['importance']);
        $this->icon       = $this->getOptionalStringArrayValue($data, 'icon');
    }
}

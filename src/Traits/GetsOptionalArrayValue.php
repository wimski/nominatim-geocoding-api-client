<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Traits;

trait GetsOptionalArrayValue
{
    /**
     * @param array<string, mixed> $data
     * @param string               $key
     * @return int|null
     */
    protected function getOptionalIntegerArrayValue(array $data, string $key): ?int
    {
        $value = $this->getOptionalArrayValue($data, $key);

        return $value === null ? $value : intval($value);
    }

    /**
     * @param array<string, mixed> $data
     * @param string               $key
     * @return string|null
     */
    protected function getOptionalStringArrayValue(array $data, string $key): ?string
    {
        $value = $this->getOptionalArrayValue($data, $key);

        return $value === null ? $value : strval($value);
    }

    /**
     * @param array<string, mixed> $data
     * @param string               $key
     * @return mixed
     */
    protected function getOptionalArrayValue(array $data, string $key): mixed
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }
}

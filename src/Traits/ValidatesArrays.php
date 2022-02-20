<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Traits;

use InvalidArgumentException;

trait ValidatesArrays
{
    /**
     * @param array<string, mixed> $array
     * @param string[] $keys
     * @throws InvalidArgumentException
     */
    protected function validateArray(array $array, array $keys): void
    {
        foreach ($keys as $key) {
            if (! array_key_exists($key, $array)) {
                throw new InvalidArgumentException("Missing key '{$key}' in array");
            }

            if ($array[$key] === null) {
                throw new InvalidArgumentException("Key '{$key}' cannot be null");
            }
        }
    }
}

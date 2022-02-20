<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Objects;

use InvalidArgumentException;
use Wimski\Nominatim\Traits\ValidatesArrays;

class NameDetails
{
    use ValidatesArrays;

    protected string $name;

    /**
     * @var array<string, string>
     */
    protected array $translatedNames = [];

    /**
     * @param array<string, mixed> $data
     * @throws InvalidArgumentException
     */
    public function __construct(array $data)
    {
        $this->validateArray($data, [
            'name',
        ]);

        $this->name = strval($data['name']);

        $this->extractTranslatedNames($data);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTranslatedName(string $languageCode): ?string
    {
        if (! array_key_exists($languageCode, $this->translatedNames)) {
            return null;
        }

        return $this->translatedNames[$languageCode];
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function extractTranslatedNames(array $data): void
    {
        $keys = array_keys($data);

        foreach ($keys as $key) {
            if (preg_match('/^name:([a-z]+)$/', $key, $matches) !== 1) {
                continue;
            }

            /** @var string $languageCode */
            $languageCode = $matches[1];

            $this->translatedNames[$languageCode] = strval($data[$key]);
        }
    }
}

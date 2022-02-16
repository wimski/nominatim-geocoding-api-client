<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Exceptions;

use Exception;

class HttpException extends Exception
{
    public function getStatusCode(): int
    {
        return $this->code;
    }
}

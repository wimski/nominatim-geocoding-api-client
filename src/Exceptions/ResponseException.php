<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ResponseException extends Exception
{
    public function __construct(
        protected ResponseInterface $response,
        protected Throwable $exception,
    ) {
        parent::__construct('Invalid response', 0, $this->exception);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}

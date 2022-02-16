<?php

declare(strict_types=1);

namespace Wimski\Nominatim\Exceptions;

use Exception;
use Psr\Http\Message\RequestInterface;
use Throwable;

class RequestException extends Exception
{
    public function __construct(
        protected RequestInterface $request,
        protected Throwable $exception,
    ) {
        parent::__construct('Request failed', 0, $this->exception);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getStatusCode(): ?int
    {
        $previous = $this->getPrevious();

        if ($previous instanceof HttpException) {
            return $previous->getCode();
        }

        return null;
    }
}

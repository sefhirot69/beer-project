<?php

namespace App\BeerCatalog\Shared\Domain\Exceptions;

use Exception;

class HttpClientException extends Exception
{
    protected $code = 400;
    protected $message = 'Bad Request httpclient error `%s`';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }

}
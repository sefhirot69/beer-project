<?php

declare(strict_types=1);

namespace App\BeerCatalog\Beer\Domain\Exceptions;

final class BeersNotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = 'Not found beer with `%s`';

    public function __construct(string $filterFood)
    {
        parent::__construct(sprintf($this->message, $filterFood), $this->code);
    }
}

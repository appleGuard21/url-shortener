<?php

declare(strict_types=1);

namespace System\Exception;

class MissingDataException extends \Exception
{
    public function __construct($message = "Missing data", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

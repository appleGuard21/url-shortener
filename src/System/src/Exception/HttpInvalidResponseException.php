<?php

declare(strict_types=1);

namespace System\Exception;

class HttpInvalidResponseException extends \Exception
{
    public function __construct($message = "Invalid HTTP response", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

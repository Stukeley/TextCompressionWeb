<?php

namespace Models;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class TextCompressionException extends Exception
{
    #[Pure] public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . "An exception has been thrown by the algorithm!" . "$this->code, $this->message";
    }
}
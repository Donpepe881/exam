<?php

class DBException extends Exception
{
    public function __construct(string $message = "", ?\Throwable $previous = null)
    {
        return parent::__construct($message, 0, $previous);
    }
}

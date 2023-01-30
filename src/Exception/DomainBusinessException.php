<?php

namespace App\Exception;

use Exception;

class DomainBusinessException extends Exception
{

    public function __construct(string $message) {
        printf($message);
    }

}
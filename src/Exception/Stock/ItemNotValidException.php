<?php

namespace App\Exception\Stock;

use DomainException;

class ItemNotValidException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Item not valid');
    }
}
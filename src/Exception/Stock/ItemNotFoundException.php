<?php

namespace App\Exception\Stock;

use App\Exception\DomainBusinessException;

class ItemNotFoundException extends DomainBusinessException
{
    public function __construct()
    {
        parent::__construct('Item not found in stock');
    }
}
<?php

namespace App\Exception\Item;

use App\Exception\DomainBusinessException;

final class InvalidPriceException extends DomainBusinessException
{

    public function __construct() {
        parent::__construct('Invalid item price');
    }

}
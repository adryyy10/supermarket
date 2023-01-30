<?php

namespace App\Item;

use App\Exception\Item\InvalidNameException;
use App\Exception\Item\InvalidPriceException;
use App\Shared\BusinessLogic;

final class Item extends BusinessLogic
{

    private string $name;
    private int $price;

    public function __construct(string $name, int $price) 
    {
        $this->name     = $name;
        $this->price    = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            throw new InvalidNameException;
        }

        if (empty($this->price)) {
            throw new InvalidPriceException;
        }
    }
}
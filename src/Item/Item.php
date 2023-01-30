<?php

namespace App\Item;

use App\Exception\Item\InvalidNameException;
use App\Exception\Item\InvalidPriceException;

class Item
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

    public function validateBusinessLogic(string $name, int $price): void
    {
        if (empty($name)) {
            throw new InvalidNameException;
        }

        if (empty($price)) {
            throw new InvalidPriceException;
        }
    }
}
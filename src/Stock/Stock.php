<?php

namespace App\Stock;

use App\Exception\Stock\ItemNotFoundException;
use App\Exception\Stock\ItemNotValidException;
use App\Item\Item;
use App\Shared\BusinessLogic;

final class Stock extends BusinessLogic
{

    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function find(string $name): Item
    {
        foreach ($this->items as $item) {
            if ($item->getName() === $name) return $item;
        }

        throw new ItemNotFoundException;
    }

    public function validate(): void
    {
        foreach ($this->items as $item) {
            if (!$item instanceof Item) throw new ItemNotValidException;
        }
    }
}
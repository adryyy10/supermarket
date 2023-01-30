<?php

namespace App\Test\Stock;

use App\Exception\Stock\ItemNotFoundException;
use App\Exception\Stock\ItemNotValidException;
use App\Item\Item;
use App\Stock\Stock;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{

    private Stock $stock;

    protected function setUp(): void
    {
        $this->stock = new Stock([
            new Item('A', 50),
            new Item('B', 75),
            new Item('C', 25)
        ]);
        $this->stock->validate();
    }

    public function testValidStockTypeData(): void
    {
        $this->assertIsArray($this->stock->getItems());

        foreach ($this->stock->getItems() as $item) {
            $this->assertInstanceOf(Item::class, $item);
        }
    }

    public function testItemFoundInStock(): void
    {
        $item = $this->stock->find('A');

        $this->assertInstanceOf(Item::class, $item);
        $this->assertEquals($this->stock->getItems()[0], $item);
    }

    public function testItemNotFoundInStockException(): void
    {
        $this->expectException(ItemNotFoundException::class);
        $this->stock->find('D');
    }

    public function testTypeItemNotValidInStockException(): void
    {
        $this->stock = new Stock([1,2]);

        $this->expectException(ItemNotValidException::class);
        $this->stock->validate();
    }

}
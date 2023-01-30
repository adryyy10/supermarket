<?php

namespace App\Test;

use App\Exception\Item\InvalidNameException;
use App\Exception\Item\InvalidPriceException;
use App\Item\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{

    protected Item $item;

    protected function setUp(): void
    {
        $this->item = new Item('A', 50);
    }

    public function testItemIsInstanceOfItem(): void
    {
        $this->assertInstanceOf(Item::class, $this->item);
    }

    public function testItemHasName(): void
    {
        $this->assertNotNull($this->item->getName());
        $this->assertEquals($this->item->getName(), 'A');
    }

    public function testItemHasEmptyNameException(): void
    {
        $this->item->setName('');

        $this->expectException(InvalidNameException::class);

        $this->item->validateBusinessLogic($this->item->getName(), $this->item->getPrice());
    }

    public function testItemHasPrice(): void
    {
        $this->assertNotNull($this->item->getPrice());
        $this->assertEquals($this->item->getPrice(), 50);
    }

    public function testItemHasEmptyPriceException(): void
    {
        $this->item->setPrice(0);

        $this->expectException(InvalidPriceException::class);

        $this->item->validateBusinessLogic($this->item->getName(), $this->item->getPrice());
    }

}
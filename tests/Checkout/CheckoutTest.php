<?php

namespace App\Test\Checkout;

use App\Checkout\Checkout;
use App\Item\Item;
use App\Stock\Stock;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{

    private Stock $stock;
    private array $pricingRules;
    private Checkout $checkout;

    protected function setUp(): void
    {
        $this->stock = new Stock([
            new Item('A', 50),
            new Item('B', 75),
            new Item('C', 25)
        ]); 
        $this->pricingRules = [];
        $this->checkout = new Checkout($this->pricingRules);
        $this->checkout->addPricingRules();
    }

    public function testValidCheckoutTypeData(): void
    {
        $this->assertInstanceOf(Checkout::class, $this->checkout);
    }

    public function testGetTotalPrice(): void
    {
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals(150, $totalPrice);
    }

    public function testCheckoutEmptyItems(): void
    {
        $this->stock = new Stock([]); 
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals(0, $totalPrice);
    }

    public function testCheckoutItemBSpecialPrice(): void
    {
        $this->stock = new Stock([
            new Item('B', 75),
            new Item('B', 75),
        ]); 
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals(125, $totalPrice);
    }

    public function testCheckoutItemBSpecialPriceTWice(): void
    {
        $this->stock = new Stock([
            new Item('B', 75),
            new Item('B', 75),
            new Item('B', 75),
            new Item('B', 75),
        ]); 
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals(250, $totalPrice);
    }

    public function testCheckoutItemCSpecialPrice(): void
    {
        $this->stock = new Stock([
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
        ]);

        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals(75, $totalPrice);
    }

    public function testCheckoutItemCSpecialPriceTwice(): void
    {
        $this->stock = new Stock([
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
        ]);

        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals(150, $totalPrice);
    }

    public function testCheckoutItemBSpecialPriceAndCSpecialPriceCombined(): void
    {
        $this->stock = new Stock([
            new Item('B', 75),
            new Item('B', 75),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
            new Item('C', 25),
        ]);

        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals(200, $totalPrice);
    }

}
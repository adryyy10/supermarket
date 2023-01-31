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

    /**
     * @param array $items
     * @param int $expected
     * 
     * @return void
     * @dataProvider itemProvider
     */
    public function testCheckoutEmptyItems(array $items, int $expected): void
    {
        $this->stock = new Stock($items); 
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @param array $items
     * @param int $expected
     * 
     * @return void
     * @dataProvider itemProvider
     */
    public function testCheckoutItemBSpecialPrice(array $items, int $expected): void
    {
        $this->stock = new Stock($items); 
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @param array $items
     * @param int $expected
     * 
     * @return void
     * @dataProvider itemProvider
     */
    public function testCheckoutItemBSpecialPriceTWice(array $items, int $expected): void
    {
        $this->stock = new Stock($items); 
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @param array $items
     * @param int $expected
     * 
     * @return void
     * @dataProvider itemProvider
     */
    public function testCheckoutItemVariety(array $items, int $expected): void
    {
        $this->stock = new Stock($items); 
        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @param array $items
     * @param int $expected
     * 
     * @return void
     * @dataProvider itemProvider
     */
    public function testCheckoutItemCSpecialPrice(array $items, int $expected): void
    {
        $this->stock = new Stock($items);

        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @param array $items
     * @param int $expected
     * 
     * @return void
     * @dataProvider itemProvider
     */
    public function testCheckoutItemCSpecialPriceTwice(array $items, int $expected): void
    {
        $this->stock = new Stock($items);

        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * @param array $items
     * @param int $expected
     * 
     * @return void
     * @dataProvider itemProvider
     */
    public function testCheckoutItemBSpecialPriceAndCSpecialPriceCombined(array $items, int $expected): void
    {
        $this->stock = new Stock($items);

        $totalPrice = $this->checkout->getTotalPrice($this->stock);

        $this->assertIsFloat($totalPrice);
        $this->assertEquals($expected, $totalPrice);
    }

    /**
     * Method that provides with $items and $expected to every test
     */
    public function itemProvider(): array
    {
     
        return [
            [
                [],
                0
            ],
            [
                [
                    new Item('B', 75),
                    new Item('B', 75),
                ],
                125
            ],
            [
                [
                    new Item('B', 75),
                    new Item('B', 75),
                    new Item('B', 75),
                    new Item('B', 75),
                ],
                250
            ],
            [
                [        
                    new Item('A', 50),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('B', 75),
                    new Item('A', 50),
                    new Item('B', 75),
                ],
                275
            ],
            [
                [
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                ],
                75
            ],
            [
                [
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                ],
                150
            ],
            [
                [
                    new Item('B', 75),
                    new Item('B', 75),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                    new Item('C', 25),
                ],
                200
            ]
        ];
        
    }
    

}
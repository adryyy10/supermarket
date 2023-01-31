<?php

namespace App\Checkout;

use App\Item\Item;
use App\Stock\Stock;

final class Checkout
{

    private array $pricingRules;

    public function __construct(array $pricingRules) 
    {
        $this->pricingRules = $pricingRules;
    }

    public function addPricingRules()
    {
        $this->pricingRules[] = function (array $items) {
            $total = 0.0;
            $count = [
                "A" => 0,
                "B" => 0,
                "C" => 0 
            ];
        
            foreach ($items as $item) {
                if ($item instanceof Item) {
                    $total += $item->calculatePrice($count);
                }
            }
        
            return $total;
        };
    }

    public function getTotalPrice(Stock $stock): float
    {
        $total = 0.0;
        $items = $stock->getItems();

        foreach ($this->pricingRules as $rule) {
            $total += $rule($items);
        }

        return $total;
    }
}
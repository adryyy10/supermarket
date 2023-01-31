<?php

namespace App\Checkout;

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
            $countB = $countC = 0;
            $total = 0.0;
        
            foreach ($items as $item) {
                if ($item->getName() === 'B') {
                    $countB++;
                    $total += ($countB % 2 != 0) ? 75 : 50;
                } else if ($item->getName() === 'C') {
                    $countC++;
                    $total += ($countC % 4 != 0) ? 25 : 0;
                } else {
                    $total += $item->getPrice();
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
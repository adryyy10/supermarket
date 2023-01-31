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
                    $total += floor($countB / 2) * 50 + ($countB % 2) * 75;
                } else if ($item->getName() === 'C') {
                    $countC++;
                    $total += floor($countC / 4) * (-75) + ($countC % 4) * 25;
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
<?php

namespace App\Interfaces;

interface PricingCalculatorInterface
{
    public function calculatePrice(array &$count): int;
}
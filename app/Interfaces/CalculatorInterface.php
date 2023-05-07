<?php

namespace App\Interfaces;


interface CalculatorInterface
{
    public function calculate(int $month): float;
}

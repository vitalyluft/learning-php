<?php
declare(strict_types=1);

/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */
class FibonacciNumberCalculator
{
    public function getFibonacciNumber(int $number)
    {
        for ($fibonacciNumber = 0; $fibonacciNumber < $number; $fibonacciNumber++) {
            if ($number < 3 && $number > 0) {
                return 1;
            }
            return $this->getFibonacciNumber($number - 1) + $this->getFibonacciNumber($number - 2);
        }
    }
}
<?php
declare(strict_types = 1);

/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */
class HanoiTowersSolver
{
    public function moveDisks(string $from, string $to, string $buffer, int $numberOfDisks): string
    {
        $solution = '';
        if ($numberOfDisks == 1) {
            $solution .= $this->getOneMove($from, $to);
        } else {
            $solution .= $this->moveDisks($from, $buffer, $to, $numberOfDisks - 1);
            $solution .= $this->getOneMove($from, $to);
            $solution .= $this->moveDisks($buffer, $to, $from, $numberOfDisks - 1);
        }
        
        return $solution;
    }
    
    private function getOneMove(string $from, string $to): string
    {
        return "$from to $to" . PHP_EOL;
    }
}
<?php
declare(strict_types = 1);
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 *         Обработка ввода/вывода
 */

class InputOutputProcessor
{
    public function getUserInput(string $message): string 
    {
        echo $message;
        $userInput = trim(fgets(STDIN));
        
        return "$userInput";
    }
    
    /**
     * @param mixed $stringForCheck
     *
     * @return bool
     */
    public function isInt($stringForCheck): bool 
    {
        if (!is_numeric($stringForCheck)
            || round($stringForCheck) != $stringForCheck
        ) {
            return false;
        }
        
        return true;
    }
}
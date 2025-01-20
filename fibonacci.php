<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая считывает из стандартного ввода целое число
 * и выводит число Фибоначчи с соответствующим порядковым номером.
 */

require_once('init.php');
const INTEGER_NUMBER_PATTERN = '/^(?:0|[1-9][0-9]*)$/';

$message = 'Для получения Числа Фибоначчи ведите целое число и нажмите Enter:' . PHP_EOL;

$processor = new InputOutputProcessor();

$data = $processor->getUserInput($message);
if (!preg_match(INTEGER_NUMBER_PATTERN, $data)) {
    exit("Получить число Фибоначчи можно только от целого числа, а вы ввели $data");
}
$fibonacciCalculator = new FibonacciNumberCalculator();
echo $fibonacciCalculator->getFibonacciNumber($data) . PHP_EOL;
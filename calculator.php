<?php
/**
 * Написать программу, которая считывает из стандартного ввода арифметическое выражение и выводит его результат.
 * Считать, что арифметическое выражение может состоять из целых чисел, знаков "+", "-", "*"
 * и скобок произвольной вложенности.
 */
require_once('init.php');

$processor = new InputOutputProcessor();
$data = $processor->getUserInput('Введите арифметическое выражение:');
if (!preg_match("/^([\(\)\*\/\-\+ ]|[0-9])*$/", $data)) {
    exit("Передано некорректное выражение."
        . "Арифметическое выражение может состоять из целых чисел,"
        . " знаков \"+\", \"-\", \"*\" и скобок произвольной вложенности."
        . PHP_EOL);
}
$calculator = new Calculator();
try {
    echo "Результат вычисления: " . $calculator->calculate($data) . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

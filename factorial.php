<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая считывает из стандартного ввода целое число и выводит его факториал
 */
require_once('plugins/getUserInput.php');
require_once('libraries/CalculateFactorial.class.php');

$message = 'Введите целое положительное число и нажмите Enter:' . PHP_EOL;

$numberToCalculateFactorial = getUserInput($message);

try
{
	$factorial = CalculateFactorial::getFactorial($numberToCalculateFactorial);
	
	echo "Факториал числа $numberToCalculateFactorial = $factorial" . PHP_EOL;
}
catch (Exception $e)
{
	echo $e->getMessage() . PHP_EOL;
}
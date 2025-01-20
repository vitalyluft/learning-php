<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая принимает в качестве аргументов основание системы счисления (число от 2 до 16)
 * и последовательность целых десятеричных чисел, которые переводит в соответствующую систему счисления
 * и выводит на экран построчно в формате "<десятеричное число> = <число в новой системе счисления>".
 * Программа должна проверять аргументы на корректность. Не использовать стандартную функцию base_convert
 */

require_once('plugins/getUserInput.php');
require_once('isInt.php');

$requestForBase = "Введите систему счисления, в которую нужно преобразовать"
	. "(число от 2 до 16), нажмите Enter:" . PHP_EOL;
$base = getUserInput($requestForBase);

if ($base < 2
	|| $base > 16
	|| !isInt($base)
)
{
	exit("Ошибка! Система счисления указана не верно" . PHP_EOL);
}

$requestForNumbers = "Введите последовательность целых десятеричных чисел,"
	. "которые нужно преобразовать, нажмите Enter:" . PHP_EOL;
$numbers = getUserInput($requestForNumbers);
$arrayNumbers = explode(" ", $numbers);

foreach ($arrayNumbers as $value)
{
	if (!isInt($value))
	{
		exit("Ошибка! Одно из переданных значений не целое число" . PHP_EOL);
	}
}

$arrayCompliance = [];

foreach ($arrayNumbers as $value)
{
	$numberToConvert = $value;
	$valueAfterConversion = "";
	
	$valueAfterConversion = changeNumberSystem($base, $numberToConvert);
	
	$arrayCompliance[$value] = $valueAfterConversion;
}

foreach ($arrayCompliance as $originValue => $convertedValue)
{
	echo "$originValue = $convertedValue" . PHP_EOL;
}

/**
 * @param integer $base
 * @param integer $numberToConvert
 *
 * @return string
 */
function changeNumberSystem($base, $numberToConvert)
{
	$resultAfterConversion = "";
	while ($numberToConvert != 0)
	{
		if ($base > 10)
		{
			if ($numberToConvert % $base < 10)
			{
				$resultAfterConversion = ($numberToConvert % $base) . $resultAfterConversion;
			} 
			elseif ($numberToConvert % $base >= 10)
			{
				$codeForChr = (55 + ($numberToConvert % $base)); // 55 это код в системе ASCII
				$resultAfterConversion = chr($codeForChr) . $resultAfterConversion;
			}
		} 
		else
		{
			$resultAfterConversion = ($numberToConvert % $base) . $resultAfterConversion;
		}
		$numberToConvert = floor($numberToConvert / $base);
	}
	
	return $resultAfterConversion;
}
<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая получает аргументами список дат вида "31.12.2015" и проверяет их на корректность.
 * По каждому аргументу вывести результат проверки - ок или нет. Учитывать число дней в месяце и високосность года.
 */

require_once('plugins/isCorrectDate.php');

array_shift($argv);
$dataToCheck = $argv;

$resultCheck = [];

foreach ($dataToCheck as $substring)
{
	if (preg_match("/^\d{2}\.\d{2}\.\d{1,4}$/", $substring))
	{
		if (isCorrectDate($substring) === true)
		{
			$resultCheck[$substring] = "Дата корректна";
		} 
		else
		{
			$resultCheck[$substring] = "Дата НЕкорректна";
		}
	} 
	else
	{
		$resultCheck[$substring] = "Аргумент некорректен.";
	}
}

foreach ($resultCheck as $value => $validity)
{
	echo "$value - $validity" . PHP_EOL;
}
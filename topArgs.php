<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, принимающую на вход последовательность аргументов.
 * Программа должна вывести 5 наиболее часто встречающихся аргументов
 * (или меньше, если было введено менее 5 различных аргументов) и кол-ва повторений для них.
 */
require_once('plugins/getUserInput.php');
echo "Введите последовательность аргументов, разделяя пробелом, нажмите Enter:" . PHP_EOL;
$args = getUserInput();
$arrayArgs = explode(" ", $args);

if (empty($args))
{
	exit("Ошибка! Вы не ввели аргументы" . PHP_EOL);
}

$arrayArgsCount = array_count_values($arrayArgs);
arsort($arrayArgsCount);

$iterationsCount = 0;
foreach ($arrayArgsCount as $key => $value)
{
	$iterationsCount++;
	if ($iterationsCount > 5)
	{
		break;
	}
	echo "Количество повторений аргумента $key = $value" . PHP_EOL;
}
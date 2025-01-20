<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, считывающую из стандартного ввода целое число N и выдающую информацию, високосный ли год N.
 * a. доработать программу, чтобы она умела считывать число из аргументов командной строки,
 * и в случае, если аргументы были, уже не обращалась к стандартному вводу
 */
if ($argc != 2)
{
	require_once('plugins/getUserInput.php');
	echo "Введите год, нажмите Enter:" . PHP_EOL;
	$year = getUserInput();
}
else
{
	$year = $argv[1];
}

if (!is_numeric($year)
	|| round($year) != $year
	|| $year <= 0
)
{
	exit("$year не является целым положительным числом" . PHP_EOL);
}

if ($year % 400 == 0
	|| $year % 4 == 0
	&& $year % 100 != 0
)
{
	echo "$year год вискосный" . PHP_EOL;
}
else
{
	echo "$year год не високосный" . PHP_EOL;
}
<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая получает на вход число аналогично п.6, но выводит сумму полностью словами,
 * "1263.34 -> одна тысяча двести шестьдесят три рубля тридцать четыре копейки".
 * Программа должна осиливать суммы как минимум исчисляющиеся сотнями миллионов (улыбка)
 * (Обратить внимание на возможное отсутствие некоторых разрядов: 1000000 -> "один миллион рублей")
 */
//Пока подключаю так, потом нужно будет делать автозагрузчик
require_once('plugins/getUserInput.php');
require_once('libraries/NumbersToWordsConverter.class.php');
require_once('libraries/NumbersToMoneyConverter.class.php');

$message = "Введите число в формате 123 или 123.45, но не более 100 триллионов и нажмите Enter:" . PHP_EOL;

$numberToConvert = getUserInput($message);

try
{
	$numberAfterConvert = NumbersToWordsConverter::convertNumbersToWords($numberToConvert);
	
	echo $numberAfterConvert . PHP_EOL;
}
catch (Exception $e)
{
	echo $e->getMessage() . PHP_EOL;
}
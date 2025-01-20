<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая считывает из стандартного ввода число с плавающей точкой и выводит его в "денежном"
 * формате по принципу: "1234567.81 -> 1 234 567 рублей 81 копейка", "1263.34 -> 1 263 рубля 34 копейки" и т.д.
 * (обратить внимание на отделение разрядов пробелами и на форму слов в зависимости от числительного).
 * Если копеек нет, не выводить по ним инфу.
 */

require_once('plugins/getUserInput.php');
require_once('libraries/NumbersToMoneyConverter.class.php');

$message = "Введите число в формате 123 или 123.45 и нажмите Enter:" . PHP_EOL;

$numberToConvert = getUserInput($message);
try
{
	$numberAfterConvert = NumbersToMoneyConverter::convertNumberToMoney($numberToConvert);
	
	echo $numberAfterConvert;
}
catch (Exception $e)
{
	echo $e->getMessage() . PHP_EOL;
}
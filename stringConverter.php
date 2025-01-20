<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая считывает из стандартного ввода строку вида: "a=1; b=2; c=agfda; derp=; eee="
 * (в конце строки точка с запятой не обязательна, ключи и значения могут содержать любые символы, кроме ";" и "=",
 * значения могут быть пустыми) и формирует массив ключ-значение, соответствующий переданной строке.
 * Результирующий массив вывести любой отладочной функцией.
 */
require_once('plugins/getUserInput.php');
$message = "Введите строку, например \"a=1; b=2; c=agfda; derp=; eee=\", нажмите Enter:" . PHP_EOL;
$stringToConvert = getUserInput($message);

$conversionResult = convertStringToArray($stringToConvert);

var_dump($conversionResult);

/**
 * @param string $stringToConvert
 *
 * @return array
 */
function convertStringToArray($stringToConvert)
{
	$conversionResult = [];
	foreach (explode(";", $stringToConvert) as $substring)
	{
		$substring = trim($substring);
		if (preg_match("/.+=/", $substring))
		{
			list($key, $value) = explode("=", $substring);
			$conversionResult[$key] = trim($value);
		}
		else
		{
			exit("Ошибка, строка не валидна" . PHP_EOL);
		}
	}
	return $conversionResult;
}

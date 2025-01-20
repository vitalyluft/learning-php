<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая переводит слова в underscore-нотации в CamelCase (a_set_of_words -> ASetOfWords)
 * и наоборот. Слова считывать из стандартного ввода, для каждого слова выбирать подходящий режим
 * (т.е. "a_word AnotherWord" - корректный ввод, должен преобразоваться в "AWord another_word").
 */

require_once('plugins/getUserInput.php');

$message = "Введите строку в underscore или CamelCase нотации, нажмите Enter:" . PHP_EOL;

$stringToConvert = getUserInput($message);

$convertedNotation = [];
$incorrectArguments = [];
foreach (explode(" ", $stringToConvert) as $substring)
{
	if (preg_match("/^[a-zA-Z0-9_]+$/", $substring))
	{
		if (strpos($substring, "_") !== false)
		{
			$convertedNotation[$substring] = underscoreToCamelCase($substring);
		}
		else
		{
			$convertedNotation[$substring] = camelCaseToUnderscore($substring);
		}
	}
	else
	{
		$incorrectArguments[$substring] = $substring;
	}
}
$result = implode(" ", $convertedNotation) . PHP_EOL;
if (!empty($incorrectArguments))
{
	$result .= "А эти аргументы некорректны: " . implode(" ", $incorrectArguments) . PHP_EOL;
}

echo $result;

/**
 * @param string $substring
 *
 * @return string
 */
function underscoreToCamelCase($substring)
{
	$changedValue = "";
	foreach (explode("_", $substring) as $value)
	{
		$lowerValue = strtolower($value);
		$changedValue .= ucfirst($lowerValue);
	}
	return $changedValue;
}

/**
 * @param string $substring
 *
 * @return bool|string
 */
function camelCaseToUnderscore($substring)
{
	$changedValue = "";
	foreach (str_split($substring, 1) as $symbol)
	{
		if (ctype_upper($symbol))
		{
			$changedValue .= "_";
			$changedValue .= strtolower($symbol);
		}
		else
		{
			$changedValue .= $symbol;
		}
	}
	if (strpos($changedValue, "_") === 0)
	{
		return substr($changedValue, 1);
	}
	return $changedValue;
}

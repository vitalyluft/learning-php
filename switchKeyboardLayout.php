<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */
require_once('plugins/getUserInput.php');
require_once('libraries/KeyboardLayoutSwitcher.class.php');

$message = "Введите строку, нажмите Enter:" . PHP_EOL;

$stringToSwitch = getUserInput($message);

if (empty($stringToSwitch))
{
	exit("Ошибка! Вы ничего не ввели" . PHP_EOL);
}
$stringAfterSwitch = '';
foreach (explode(" ", $stringToSwitch) as $substring)
{
	if (preg_match("/[а-яА-Я]/", "$substring"))
	{
		$stringAfterSwitch .= KeyboardLayoutSwitcher::switchRuToEn($substring) . " ";
	}
	else
	{
		$stringAfterSwitch .= KeyboardLayoutSwitcher::switchEnToRu($substring) . " ";
	}
}

echo "$stringAfterSwitch" . PHP_EOL;

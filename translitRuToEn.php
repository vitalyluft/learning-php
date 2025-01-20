<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая транслитерирует кириллический текст,
 * читая его из стандартного ввода и выплевывая результат в стандартный вывод.
 */

require_once('plugins/getUserInput.php');
require_once('plugins/getTranslitRuToEn.php');

$message = "Введите строку для транслитерации, нажмите Enter:" . PHP_EOL;

$stringToTranslit = getUserInput($message);

if (empty($stringToTranslit))
{
	exit("Ошибка! Вы ничего не ввели" . PHP_EOL);
}

$stringAfterTranslit = getTranslitRuToEn($stringToTranslit);

echo "$stringAfterTranslit" . PHP_EOL;

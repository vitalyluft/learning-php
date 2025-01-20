<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Функция проверяет, является ли введенная строка целым числом.
 */

/**
 * @param string $stringForCheck
 *
 * @return bool
 */
function isInt($stringForCheck)
{
	if (!is_numeric($stringForCheck)
		|| round($stringForCheck) != $stringForCheck
	)
	{
		return false;
	}
	return true;
}
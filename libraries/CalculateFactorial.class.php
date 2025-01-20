<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 */

declare(strict_types = 1);

class CalculateFactorial
{
	const INTEGER_NUMBER_PATTERN = '/^(?:0|[1-9][0-9]*)$/';
	
	/**
	 * @throws Exception
	 */
	public static function getFactorial($numberToCalculateFactorial)
	{
		if (!preg_match(self::INTEGER_NUMBER_PATTERN, $numberToCalculateFactorial))
		{
			throw new Exception(
				"Получить факториал можно только от целого числа, а вы ввели $numberToCalculateFactorial"
			);
		}
		
		if ($numberToCalculateFactorial == 0)
		{
			return 1;
		}
		
		return $numberToCalculateFactorial * self::getFactorial($numberToCalculateFactorial - 1);
	}
}
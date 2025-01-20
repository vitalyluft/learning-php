<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */
declare(strict_types = 1);

class NumbersToMoneyConverter
{
	const FLOAT_NUMBER_PATTERN = '/^[0-9]{1,13}(\.\d{1,2})?$/';
	
	private const _RUBLES = [' рубль ', ' рубля ', ' рублей '];
	
	/**
	 * @throws Exception
	 */
	public static function convertNumberToMoney(string $numberToConvert): string
	{
		if (!preg_match(self::FLOAT_NUMBER_PATTERN, $numberToConvert))
		{
			throw new Exception('Ошибка! Введенное значение некорректно');
		}
		
		$values = explode(".", $numberToConvert);
		$rubles = (float)$values[0];
		
		if (preg_match("/\./", $numberToConvert))
		{
			$kopecks = (float)$values[1];
			
			return $moneyFormat = number_format($rubles, 0, '.', ' ')
				. self::getWordForm($rubles, self::_RUBLES)
				. "$kopecks" . self::getWordForm($kopecks, self::_RUBLES) . PHP_EOL;
		}
		
		return $moneyFormat = number_format($rubles, 0, '.', ' ')
			. self::getWordForm($rubles, self::_RUBLES) . PHP_EOL;
	}
	
	//$wordForms = [$nominativeSingular, $genitiveSingular, $genitivePlural]
	public static function getWordForm(float $moneyAmount, array $wordForms): string
	{
		$numberToCheck = (int)(substr((string)$moneyAmount, -2, 2)
		);
		if (($numberToCheck % 100 >= 11)
			&& ($numberToCheck % 100 <= 19)
		)
		{
			return $wordForms[2];
		}
		else
		{
			switch ($numberToCheck % 10)
			{
				case 1:
					return $wordForms[0];
				case 2:
				case 3:
				case 4:
					return $wordForms[1];
				default:
					return $wordForms[2];
			}
		}
	}
}
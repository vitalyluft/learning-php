<?php
declare(strict_types = 1);
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */

require_once('NumbersToMoneyConverter.class.php');

class NumbersToWordsConverter
{
	private const _HUNDREDS = [
		0 => '',
		1 => 'сто',
		2 => 'двести',
		3 => 'триста',
		4 => 'четыреста',
		5 => 'пятьсот',
		6 => 'шестьсот',
		7 => 'семьсот',
		8 => 'восемьсот',
		9 => 'девятьсот'
	];
	
	private const _TENS = [
		0 => '',
		1 => 'десять',
		2 => 'двадцать',
		3 => 'тридцать',
		4 => 'сорок',
		5 => 'пятьдесят',
		6 => 'шестьдесят',
		7 => 'семьдесят',
		8 => 'восемьдесят',
		9 => 'девяносто'
	];
	
	private const _BETWEEN11AND19 = [
		1 => 'одиннадцать',
		2 => 'двенадцать',
		3 => 'тринадцать',
		4 => 'четырнадцать',
		5 => 'пятнадцать',
		6 => 'шестнадцать',
		7 => 'семнадцать',
		8 => 'восемнадцать',
		9 => 'девятнадцать'
	];
	
	private const _UNITS = [
		0 => 'ноль',
		1 => ['male'   => 'один',
			  'female' => 'одна'],
		2 => ['male'   => 'два',
			  'female' => 'две'],
		3 => 'три',
		4 => 'четыре',
		5 => 'пять',
		6 => 'шесть',
		7 => 'семь',
		8 => 'восемь',
		9 => 'девять'
	];
	
	private const _CURRENCY = [
		'int'   => ['рубль', 'рубля', 'рублей'],
		'float' => ['копейка', 'копейки', 'копеек']
	];
	
	private const _FORMS = [
		'float'     => self::_CURRENCY['float'],
		'int'       => self::_CURRENCY['int'],
		'thousand'  => ['тысяча', 'тысячи', 'тысяч'],
		'millions'  => ['миллион', 'миллиона', 'миллионов'],
		'billions'  => ['миллиард', 'миллиарда', 'миллиардов'],
		'trillions' => ['триллион', 'триллиона', 'триллионов']
	];
	
	private const _GENDER = [
		'float'     => 'female',
		'int'       => 'male',
		'thousand'  => 'female',
		'millions'  => 'male',
		'billions'  => 'male',
		'trillions' => 'male'
	];
	
	/**
	 * @throws Exception
	 */
	public static function convertNumbersToWords(string $numberToConvert): string
	{
		if (!preg_match(NumbersToMoneyConverter::FLOAT_NUMBER_PATTERN, $numberToConvert))
		{
			
			throw new Exception("Ошибка! Значение \"$numberToConvert\" некорректно.");
		}
		
		$numbersToConvert = self::_getIntAndFloat($numberToConvert);
		
		$intToConvert = self::_splitIntegerIntoDischarges(self::_getNormalizedValue($numbersToConvert['int']));
		$intOfWords = [];
		foreach ($intToConvert as $form => $value)
		{
			if ($form != 'int' && $value == 0)
			{
				continue;
			}
			
			$convertedValue = self::_getConvertedNumber((string)$value, (string)self::_GENDER[$form]);
			$categoryOfValue = NumbersToMoneyConverter::getWordForm((int)$value, self::_FORMS[$form]);
			$intOfWords[] = $convertedValue . ' ' . $categoryOfValue;
		}
		
		$numberOfWords = self::_cleanExtraZeros(implode(' ', array_reverse($intOfWords)));
		
		if (isset($numbersToConvert['float']))
		{
			$floatToConvert = self::_getNormalizedValue((string)$numbersToConvert['float']);
			$convertedFloat = self::_getConvertedNumber($floatToConvert, (string)self::_GENDER['float']);
			$categoryOfFloat = NumbersToMoneyConverter::getWordForm((int)$floatToConvert, self::_FORMS['float']);
			$floatOfWords = $convertedFloat . ' ' . $categoryOfFloat;
			$numberOfWords .= ' ' . self::_cleanExtraZeros($floatOfWords);
		}
		
		return $numberOfWords;
	}
	
	private static function _getIntAndFloat(string $numberToConvert): array
	{
		$values = explode(".", $numberToConvert);
		
		$intAndFloat['int'] = $values[0];
		
		if (array_key_exists(1, $values))
		{
			$intAndFloat['float'] = $values[1];
		}
		
		return $intAndFloat;
	}
	
	private static function _splitIntegerIntoDischarges(string $int): array
	{
		$integerAfterSplit = array_reverse(str_split($int, 3));
		$integerOfDischarges = [];
		foreach ($integerAfterSplit as $key => $value)
		{
			switch ($key)
			{
				case 0:
					$discharges = 'int';
					$integerOfDischarges[$discharges] = $value;
					break;
				case 1:
					$discharges = 'thousand';
					$integerOfDischarges[$discharges] = $value;
					break;
				case 2:
					$discharges = 'millions';
					$integerOfDischarges[$discharges] = $value;
					break;
				case 3:
					$discharges = 'billions';
					$integerOfDischarges[$discharges] = $value;
					break;
				case 4:
					$discharges = 'trillions';
					$integerOfDischarges[$discharges] = $value;
			}
		}
		
		return $integerOfDischarges;
	}
	
	private static function _getNormalizedValue(string $valueForNormalize): string
	{
		return str_pad($valueForNormalize, (int)ceil(strlen($valueForNormalize) / 3) * 3, '0', STR_PAD_LEFT);
	}
	
	private static function _getConvertedNumber(string $number, string $gender): string
	{
		$convertedNumber = [];
		
		$hundred = (int)substr((string)$number, 0, 1);
		$ten = (int)substr((string)$number, 1, 1);
		$unit = (int)substr((string)$number, 2, 1);
		$tenAndUnit = (int)$ten . $unit;
		
		$convertedNumber[] = self::_HUNDREDS[$hundred];
		if ($tenAndUnit > 10 && $tenAndUnit < 20)
		{
			$convertedNumber[] = self::_BETWEEN11AND19[$unit];
		}
		else
		{
			$convertedNumber[] = self::_TENS[$ten];
			
			if ($unit == 1 || $unit == 2)
			{
				$convertedNumber[] = self::_UNITS[$unit][$gender];
			}
			else
			{
				$convertedNumber[] = self::_UNITS[$unit];
			}
		}
		
		return implode(' ', array_diff($convertedNumber, ['']));
	}
	
	private static function _cleanExtraZeros(string $stringForCleaning): string
	{
		return str_replace(' ноль', '', $stringForCleaning);
	}
}
<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая получает список дат аналогично п. 2 и выводит корректные даты в хронологическом порядке
 */

require_once('plugins/isCorrectDate.php');

array_shift($argv);
$dataToCheck = $argv;

foreach ($dataToCheck as $substring)
{
	if (preg_match("/^\d{2}\.\d{2}\.\d{1,4}$/", $substring))
	{
		if (isCorrectDate($substring) === true)
		{
			$correctDates[] = $substring;
		}
	}
}
if (empty($correctDates))
{
	exit("Вы не ввели ни одной корректной даты." . PHP_EOL);
}

usort($correctDates, 'comparingDates');

foreach ($correctDates as $date)
{
	echo $date . PHP_EOL;
}


/**
 * @param string $date1
 * @param string $date2
 *
 * @return int
 */
function comparingDates($date1, $date2)
{
	list($day1, $month1, $year1) = explode(".", $date1);
	list($day2, $month2, $year2) = explode(".", $date2);
	if ($year1 == $year2)
	{
		if ($month1 == $month2)
		{
			if ($day1 == $day2)
			{
				return 0;
			}
			
			return ($day1 > $day2)
				? 1
				: -1;
		}
		
		return ($month1 > $month2)
			? 1
			: -1;
	}
	
	return ($year1 > $year2)
		? 1
		: -1;
}

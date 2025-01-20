<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */

/**
 * @param string $datesToCheck
 *
 * @return bool
 */
function isCorrectDate($datesToCheck)
{
	list($day, $month, $year) = explode(".", $datesToCheck);
	if (isCorrectMonth($month) === true
		&& iscorrectDay($day, $month, $year) === true
	)
	{
		return true;
	}
	
	return false;
}

/**
 * @param int $year
 *
 * @return bool
 */
function isLeap($year)
{
	if ($year % 400 == 0
		|| $year % 4 == 0
		&& $year % 100 != 0
	)
	{
		return true;
	}
	
	return false;
}

/**
 * @param int $month
 *
 * @return bool
 */
function isCorrectMonth($month)
{
	if ($month >= 1
		&& $month <= 12
	)
	{
		return true;
	}
	
	return false;
}

/**
 * @param int $day
 * @param int $month
 * @param int $year
 *
 * @return bool
 */
function isCorrectDay($day, $month, $year)
{
	$maxDays = maxDaysInMonth($month, $year);
	if ($day >= 1
		&& $day <= $maxDays
	)
	{
		return true;
	}
	
	return false;
}

/**
 * @param int $month
 * @param int $year
 *
 * @return int|null
 */
function maxDaysInMonth($month, $year)
{
	$maxDays = null;
	switch ($month)
	{
		case "1":
		case "3":
		case "5":
		case "7":
		case "8":
		case "10":
		case "12":
			$maxDays = 31;
			break;
		case "2":
			if (isLeap($year) === true)
			{
				$maxDays = 29;
			}
			else
			{
				$maxDays = 28;
			}
			break;
		case "4":
		case "6":
		case "9":
		case "11":
			$maxDays = 30;
			break;
	}
	
	return $maxDays;
}
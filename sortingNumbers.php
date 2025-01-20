<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу,
 * принимающую в качестве аргументов произвольную последовательность целых чисел и выводящую эти числа:
 * a. в обратном порядке
 * b. в порядке возрастания
 * c. в порядке убывания
 *
 * К программе из п. 4 добавить вывод доли (в %) каждого числа от суммы всех введенных чисел.
 * Дробные числа округлять до 2 знаков после запятой
 *
 * К программе из п. 5 добавить проверку, что все, что вводит пользователь, является целым числом.
 * В случае ошибки программа должна сообщать, какой именно аргумент плохой (выводить его значение)
 * и завершаться без дальнейших вычислений.
 * Вывод информации об ошибке должен происходить в стандартный поток ошибок (STDERR)
 *
 * К программе из п. 6 добавить возможность управлять выводом с помощью опций
 * a. -p - если задана эта опция, выводить доли из п. 5, иначе - только числа
 * b. --order=<reverse|asc|desc> - если задана такая опция, выводить числа соответственно как в 4a, 4b, 4c.
 * Если не задана, выводить в исходном порядке.
 */
require_once('plugins/getUserInput.php');
echo "Введите последовательность целых чисел, разделяя пробелом, нажмите Enter:" . PHP_EOL;
$numbers = getUserInput();
$arrayNumbers = explode(" ", $numbers);

foreach ($arrayNumbers as $value)
{
	if (!is_numeric($value)
		|| round($value) != $value
	)
	{
		$arrayBadArgs[] = $value;
	}
}

if (!empty($arrayBadArgs))
{
	$stringBadArgs = implode(" ", $arrayBadArgs);
	exit("Ошибка! Эти аргументы не являются целым числом: $stringBadArgs" . PHP_EOL);
}

$arrayOptions = [
	"order::"
];
$options = getopt("p", $arrayOptions);

if (empty($options))
{
	echo "Вы не задали ниодной опции сортировки." . PHP_EOL
	. "Какие бывают опции: " . PHP_EOL
	. "-p              - вывод доли (в %) каждого числа от суммы всех введенных чисел" . PHP_EOL
	. "--order=reverse - вывод в обратном порядке" . PHP_EOL
	. "--order=asc     - вывод в порядке возрастания" . PHP_EOL
	. "--order=desc    - вывод в порядке убывания" . PHP_EOL
	. "Сейчас вы ввели: $numbers" . PHP_EOL;
}

if (isset($options['order']))
{
	switch ($options['order'])
	{
		case "reverse":
			$reversedStringNumbers = implode(" ", array_reverse($arrayNumbers));
			echo "Числа отсортированы в обратном порядке:"
				. PHP_EOL . $reversedStringNumbers . PHP_EOL;
			break;
		case "asc":
			sort($arrayNumbers);
			$numbersInAscendingOrder = implode(" ", $arrayNumbers);
			echo "Числа отсортированы в порядке возрастания:"
				. PHP_EOL . $numbersInAscendingOrder . PHP_EOL;
			break;
		case "desc":
			rsort($arrayNumbers);
			$numbersInDescendingOrder = implode(" ", $arrayNumbers);
			echo "Числа отсортированы в порядке убывания:"
				. PHP_EOL . $numbersInDescendingOrder . PHP_EOL;
			break;
	}
}

if (isset($options['p']))
{
	$sum = array_sum($arrayNumbers);
	
	if ($sum <= 0)
	{
		exit("Невозможно рассчитать процентное соотношение, сумма всех чисел в массиве меньше или равна нулю" . PHP_EOL);
	}
	$percents = [];
	foreach ($arrayNumbers as $value)
	{
		if ($value >= 0)
		{
			$percents[$value] = $value * 100 / $sum;
		}
		else
		{
			exit("Невозможно рассчитать процентное соотношение, одно из значений массива меньше нуля" . PHP_EOL);
		}
	}
	foreach ($percents as $key => $value)
	{
		echo "$key составляет " . round($value, 2) . "% от суммы всех чисел в массиве" . PHP_EOL;
	}
}
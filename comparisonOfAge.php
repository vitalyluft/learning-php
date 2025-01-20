<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая спрашивает возраст пользователя (число полных лет),
 * и выводит информацию о том, на сколько лет пользователь младше Пушкина, Лермонтова, Л. Н. Толстого.
 * Информацию представить в виде человекопонятного предложения в произвольной форме.
 */
echo "What is your age?" . PHP_EOL;
$userAge = trim(fgets(STDIN));
if (!is_numeric($userAge)
	|| $userAge > 150
	|| $userAge < 0
	|| round($userAge) != $userAge
)
{
	exit("Error! Age is not correct." . PHP_EOL);
}
$writersBirthYears = [
	'Pushkin'   => 1799,
	'Lermontov' => 1814,
	'Tolstoy'   => 1828,
];
foreach ($writersBirthYears as $writer => $year)
{
	echo "Your difference in years with $writer: " . ((date('Y')) - $year - $userAge) . PHP_EOL;
}
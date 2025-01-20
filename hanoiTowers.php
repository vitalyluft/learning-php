<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу для решения задачи о ханойских башнях (https://ru.wikipedia.org/wiki/Ханойская_башня).
 * Пусть есть стержни A, B, C, нам нужно перенести N дисков со стержня A на C.
 * Число N вводит пользователь, программа построчно должна распечатать последовательность перекладываний дисков
 * (напр. "A to B; A to C; B to C" для N = 2).
 */
require_once('init.php');

$message = 'Введите количество дисков:';
$processor = new InputOutputProcessor();
$data = $processor->getUserInput($message);
if (!$processor->isInt($data) || $data <= 0) {
    exit("Количество дисков должно быть целым числом больше 0, а вы ввели $data" . PHP_EOL);
}
$solver = new HanoiTowersSolver();
echo $solver->moveDisks('A', 'C', 'B', $data);
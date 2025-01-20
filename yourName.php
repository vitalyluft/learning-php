<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая спрашивает при запуске
 * имя пользователя с приглашением "What is your name?"
 * и выводит фразу "Hello, <введенное_имя>!"
 */
echo "What is your name?" . PHP_EOL;
$userName = trim(fgets(STDIN));
$errorMessage = "Error! You have not entered a name.";
if (empty($userName))
{
    exit($errorMessage . PHP_EOL);
}
echo "Hello, $userName!" . PHP_EOL;

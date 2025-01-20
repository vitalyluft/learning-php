<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */
spl_autoload_register('autoload');
function autoload($className)
{
    $fileName = 'libraries/' . $className . '.class.php';
    require_once($fileName);
}
<?php
/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 * Написать программу, которая получает в качестве аргумента имя файла,
 * откуда считывает пары ключ-значение вида: "a.b.c=1; a.b.d=2; a.c.e=3; a.c.f=4; b=5"
 * и преобразует их в xml-документ соответствующей структуры (точки задают уровень вложенности узла).
 * Считать, что нельзя задать значение a.b, если задано, например, a.b.c.
 * Пример результата (для приведенной строки ввода):
 *
 * <a>
 *      <b>
 *          <c>1</c>
 *          <d>2</d>
 *      </b>
 *      <c>
 *          <e>3</e>
 *          <f>4</f>
 *      </c>
 * </a>
 * <b>5</b>
 */
require_once('init.php');
$ioProcessor = new InputOutputProcessor();
$inputFile = $ioProcessor->getUserInput('Введите имя файла:');
$outputFile = 'tmp/convertedToXml.xml';
$dataInFile = file_get_contents($inputFile);
$converter = new XmlConverter();
try {
    $xml = $converter->convertToXml($dataInFile);
    file_put_contents($outputFile, $xml);
    echo "Результат в файле: $outputFile" . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage()
        . PHP_EOL
        . 'Файл должен содержать пары ключ-значение вида: "a.b.c=1; a.b.d=2; a.c.e=3; a.c.f=4; b=5".'
        . PHP_EOL . 'При этом нельзя задать значение a.b, если задано, например, a.b.c.'
        . PHP_EOL;

}
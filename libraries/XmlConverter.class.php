<?php
declare(strict_types=1);

/**
 * @author Vitaliy Luft <luft@tutu.ru>
 *
 */
class XmlConverter
{
    public function convertToXml(string $fullString): string
    {
        $arrayToConvert = $this->getArrayForConvert($fullString);

        return $this->convertArrayToXml($arrayToConvert);
    }

    private function convertArrayToXml(array $arrayToConvert, int $recursionLevel = 0): string
    {
        $xmlString = '';
        foreach ($arrayToConvert as $tag => $value) {
            if (is_numeric($tag)) {
                throw new Exception("Данные для конвертации невалидны");
            }
            if (is_array($value)) {
                $xmlString .= str_repeat("\t", $recursionLevel) . "<$tag>" . PHP_EOL
                    . $this->convertArrayToXml($value, $recursionLevel + 1) . str_repeat("\t",
                        $recursionLevel) . "</$tag>" . PHP_EOL;
            } else {
                $xmlString .= str_repeat("\t", $recursionLevel) . "<$tag>$value</$tag>" . PHP_EOL;
            }
        }

        return $xmlString;
    }

    private function getArrayForConvert(string $data): array
    {
        $arrayForConvert = [];
        $arrayOfElements = [];
        $elementsString = $this->cleanEmptyElements(explode(";", $data));
        foreach ($elementsString as $stringElement) {
            $arrayOfElements[trim($stringElement)] = $this->splitIntoKeyAndValue(trim($stringElement));
        }

        foreach ($arrayOfElements as $oneArray) {
            $arrayForConvert = array_merge_recursive($arrayForConvert, $oneArray);
        }

        return $arrayForConvert;
    }

    private function splitIntoKeyAndValue(string $string): array
    {
        $keyValue = explode(".", $string, 2);
        if (count($keyValue) > 1) {
            return [$keyValue[0] => $this->splitIntoKeyAndValue($keyValue[1])];
        } else {
            $internalArray = explode("=", $keyValue[0]);

            return [$internalArray[0] => $internalArray[1]];
        }
    }

    private function cleanEmptyElements(array $arrayForCleaning): array
    {
        return array_diff($arrayForCleaning, ['', ' ']);
    }
}
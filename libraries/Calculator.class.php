<?php
declare(strict_types=1);

class Calculator
{
    /**
     * @throws Exception
     */
    public function calculate(string $mathematicalExpression): string
    {
        $postfixExpression = $this->getPostfixExpression($mathematicalExpression);
        $stack = [];
        $result = '';
        $token = strtok($postfixExpression, ' ');
        while ($token !== false) {
            if (preg_match("/[\+\-\*\/]/", $token)) {
                if (count($stack) < 2) {
                    throw new Exception("Недостаточно данных в стеке для операции '$token'");
                }
                $b = array_pop($stack);
                $a = array_pop($stack);
                switch ($token) {
                    case '*':
                        $result = $a * $b;
                        break;
                    case '/':
                        $result = $a / $b;
                        break;
                    case '+':
                        $result = $a + $b;
                        break;
                    case '-':
                        $result = $a - $b;
                        break;

                }
                array_push($stack, "$result");
            } elseif (is_numeric($token)) {
                array_push($stack, $token);
            } else {
                throw new Exception("Недопустимый символ в выражении: $token");
            }

            $token = strtok(' ');
        }
        if (count($stack) > 1) {
            throw new Exception("Количество операторов не соответствует количеству операндов");
        }
        return array_pop($stack);
    }
    
    public function getPostfixExpression(string $infixExpression): string
    {
        $stack = [];
        $out = [];

        $operatorPrecedence = [
            "*" => "3",
            "/" => "3",
            "+" => "2",
            "-" => "2",
            "(" => "1",
        ];

        $token = str_replace(" ", "", $infixExpression);
        $token = str_split($token);

        if (preg_match("/[\+\-\*\/]/", $token['0'])) {
            array_unshift($token, "0");
        }

        $lastSymbolIsNumber = true;
        foreach ($token as $value) {

            if (preg_match("/[\+\-\*\/]/", $value)) {
                $lastSymbolIsOperator = false;

                while ($lastSymbolIsOperator != true) {
                    $previousOperator = array_pop($stack);
                    if ($previousOperator == "") {
                        $stack[] = $value;
                        $lastSymbolIsOperator = true;
                    } else {
                        $priorityCurrentOperator = $operatorPrecedence[$value];
                        $priorityPreviousOperator = $operatorPrecedence[$previousOperator];

                        switch ($priorityCurrentOperator) {
                            case ($priorityCurrentOperator > $priorityPreviousOperator):
                                $stack[] = $previousOperator;
                                $stack[] = $value;
                                $lastSymbolIsOperator = true;
                                break;

                            case ($priorityCurrentOperator <= $priorityPreviousOperator):
                                $out[] = $previousOperator;
                                break;
                        }
                    }
                }
                $lastSymbolIsNumber = false;
            } elseif (preg_match("/[0-9]/", $value)) {
                if ($lastSymbolIsNumber == true) {
                    $num = array_pop($out);
                    $out[] = $num . $value;
                } else {
                    $out[] = $value;
                    $lastSymbolIsNumber = true;
                }
            } elseif ($value == "(") {
                $stack[] = $value;
                $lastSymbolIsNumber = false;
            } elseif ($value == ")") {
                $openingBracketFound = false;
                while ($openingBracketFound != true) {
                    $operator = array_pop($stack);

                    if ($operator == "(") {
                        $openingBracketFound = true;
                    } else {
                        $out[] = $operator;
                    }
                }
                $lastSymbolIsNumber = false;
            }

        }
        $dataForReversePolishNotation = $out;

        while ($stackElement = array_pop($stack)) {
            $dataForReversePolishNotation[] = $stackElement;
        }

        return implode(" ", $dataForReversePolishNotation);
    }
}

<?php
// Проверяем, был ли запрос отправлен методом POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $expression = $_POST['expression'];// Получаем выражение из POST-запроса
        
        // Проверяем выражение на корректность (только цифры, операторы и пробелы)
        if (preg_match("/^[0-9\+\-\*\/\(\)sin\(\)cos\(\)tg\(\)ctg\(\)\. ]+$/", $expression)) {
            $result = calculateExpression($expression); // Вычисляем результат выражения через функцию calculateMathExpression
            echo $result; // Выводим результат
            // Выводим сообщение об ошибке при некорректном выражении
        } else if ($expression == '') {
            echo 'Ничего не введено!';
        }
        else {
            echo 'Неверное выражение!';
        }
    }
// Функция для вычисления математического выражения
    function calculateExpression($expression) {
        $expression = str_replace(' ', '', $expression);
        return calculateAdditionAndSubtraction($expression);
    }
// Функция для вычисления суммы и разности
    function calculateAdditionAndSubtraction(&$expression) {
        $result = calculateMultiplicationAndDivision($expression);
             // Вычисляем умножение и деление в выражении
        while (strlen($expression) > 0) {
            $operator = $expression[0];
            
            if ($operator == '+' || $operator == '-') {
                $expression = substr($expression, 1);
                $num2 = calculateMultiplicationAndDivision($expression);
                    // Выполняем сложение или вычитание
                    // в зависимости от оператора
                if ($operator == '+') {
                    $result += $num2;
                } elseif ($operator == '-') {
                    $result -= $num2;
                }
            } else {
                break;//выходим из цикла если нет + или -
            }
        }

        return $result;
    }
    // Функция для вычисления умножения и деления
    function calculateMultiplicationAndDivision(&$expression) {
        $result = calculateTrigonometricFunctions($expression);// Вычисляем числа в выражении

        while (strlen($expression) > 0) {
            $operator = $expression[0];

            if ($operator == '*' || $operator == '/') {
                $expression = substr($expression, 1);
                $num2 = calculateTrigonometricFunctions($expression);
                // Выполняем умножение или деление
                // в зависимости от оператора
                if ($operator == '*') {
                    $result *= $num2;
                } elseif ($operator == '/') {
                    if ($num2 == 0) {
                        $result = 'Деление на ноль!';
                    } else {
                        $result /= $num2;
                    }
                }
            } else {
                break; //выходим из цикла если нет * или /
            }
        }

        return $result;
    }
    // Расчёт sin , cos , tg и ctg
    function calculateTrigonometricFunctions(&$expression) {
        $result = calculateNumber($expression);
    
        while (strlen($expression) > 0) {
            if (substr($expression, 0, 3) == 'cos') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = cos($numInRadians);
            } else if (substr($expression, 0, 3) == 'sin') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = sin($numInRadians);
            }  else if (substr($expression, 0, 2) == 'tg') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = tan($numInRadians);
            }  else if (substr($expression, 0, 3) == 'ctg') {
                $expression = substr($expression, 3);
                $num = calculateNumber($expression);
                $numInRadians = $num * M_PI / 180;
                $result = 1 / tan($numInRadians);
            } else {
                break;
            }
        }
    
        return $result;
    }
    // Функция для вычисления числа в выражении
    function calculateNumber(&$expression) {
        $number = "";
        // Если число находится в скобках, вычисляем его сумму и разность
        if ($expression[0] == "(") {
            $expression = substr($expression, 1);
            $number = calculateAdditionAndSubtraction($expression);
            $expression = substr($expression, 1); 
        } else {
            while (strlen($expression) > 0 && (is_numeric($expression[0]) || $expression[0] == '.')) {
                $number .= $expression[0];
                $expression = substr($expression, 1);
            }
            $number = floatval($number);
        }
    
        return $number;
    }
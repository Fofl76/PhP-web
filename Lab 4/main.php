<?php
$data = json_decode(file_get_contents('php://input'), true);
$expression = $data['expression'];

function calculate_expression($expression) {
    $operators = '+-*/';
    $stack = new SplStack();
    
    $tokens = explode(' ', $expression);
    foreach ($tokens as $token) {
        if (is_numeric($token)) {
            $stack->push($token);
        } else if (strpos($operators, $token) !== false) {
            $num2 = $stack->pop();
            $num1 = $stack->pop();
            switch ($token) {
                case '+':
                    $result = $num1 + $num2;
                    break;
                case '-':
                    $result = $num1 - $num2;
                    break;
                case '*':
                    $result = $num1 * $num2;
                    break;
                case '/':
                    $result = $num1 / $num2;
                    break;
            }
            $stack->push($result);
        }
    }
    
    return $stack->pop();
}

$result = calculate_expression($expression);
echo json_encode(['result' => $result]);
?>

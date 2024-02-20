<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$letters = ['a', 'b', 'c', 'b', 'a'];

$letterCount = array_count_values($letters);

foreach ($letterCount as $letter => $count) {
    echo "Буква '$letter' встречается $count раз(а).<br>";
}

$originalArray = ['a' => 1, 'b' => 2, 'c' => 3];

$flippedArray = array_flip($originalArray);

$reversedArray = array_reverse($flippedArray, true);

print_r($reversedArray);
echo '<br>';
$keys = ['a', 'b', 'c'];
$values = [1, 2, 3];

$assocArray = array_combine($keys, $values);

print_r($assocArray);
echo '<br>';
$array = array('a', 'b', 'c', 'd', 'e');
$upperArray = array_map('strtoupper', $array);
print_r($upperArray);
echo '<br>';

$arr1 = array(1, 2, 3);
$arr2 = array('a', 'b', 'c');
$result = array_merge($arr1, $arr2);
print_r($result);

echo '<br>';
$array = [1, 2, 3, 4, 5];
$product = array_product($array);
echo "Произведение элементов массива: ", $product;

echo '<br>';
$array = ['a' => 1, 'b' => 2, 'c' => 3]; 
$rand_key = array_rand($array); 
echo $array[$rand_key]; 

echo '<br>';
$array = ["a", "b", "c", "d", "e"];  
$array = array_replace(array("!"), array_slice($array, 0, 1), array_splice($array, 3));  
print_r($array);

echo '<br>';
$arr = ['a', '-', 'b', '-', 'c', '-', 'd'];
$pos = array_search('-', $arr);
echo $pos; 

echo '<br>';
$array = [1, 2, 3, 4, 5];
echo 'Исходный массив: '.implode(', ', $array).PHP_EOL;
array_shift($array);
echo 'Массив после удаления первого элемента: '.implode(', ', $array).PHP_EOL;
$lastElement = array_pop($array);
$array[] = $lastElement;
echo 'Массив после добавления последнего элемента: '.implode(', ', $array).PHP_EOL; 
?>

</body>
</html>


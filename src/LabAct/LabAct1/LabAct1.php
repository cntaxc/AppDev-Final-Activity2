<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice</title>
    <style>
        pre { font-family: monospace; }
    </style>
</head>
<body>
<pre>
<?php
$numbers = [10, 20, 30, 40, 50];
$fruits = ["Apple", "Banana", "Cherry", "Date", "Elderberry"];

foreach ($fruits as $fruits) {
    echo "$fruits\n";
}

echo "===== FOR LOOP =====\n";
for ($i = 0, $len = count($numbers); $i < $len; $i++) {
    echo "Index $i: {$numbers[$i]}\n";
}

echo "\n===== FOREACH LOOP =====\n";
foreach ($numbers as $index => $value) {
    echo "Index $index: $value\n";
}

echo "\n===== WHILE LOOP =====\n";
$i = 0;
$len = count($numbers);
while ($i < $len) {
    echo "Index $i: {$numbers[$i]}\n";
    $i++;
}

echo "\n===== DO...WHILE LOOP =====\n";
$i = 0;
do {
    echo "Index $i: {$numbers[$i]}\n";
    $i++;
} while ($i < $len);

echo "\n===== NESTED LOOP (Matrix Example) =====\n";
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

foreach ($matrix as $row) {
    foreach ($row as $value) {
        echo "$value ";
    }
    echo "\n";
}
?>
</pre>
</body>
</html>

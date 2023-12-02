<?php

$input = file_get_contents('./input.txt');

$sum = 0;
foreach (preg_split("/\r\n|\n|\r/", $input) as $loop => $sentence) {
    [, $cubes_string] = explode(':', $sentence);

    $cubes = preg_split('/[;,]/', $cubes_string);

    $amounts_per_color = [];
    foreach ($cubes as $cube) {
        [$amount, $color] = explode(' ', trim($cube));
        $amounts_per_color[$color][] = $amount;
    }

    $maxes = [];
    foreach ($amounts_per_color as $color => $amount) {
        $maxes[] = max($amount);
    }

    $sum += array_product($maxes);
}
echo $sum . PHP_EOL;

<?php

$input = file_get_contents('./input.txt');

$maxes = [
    'red' => 12,
    'green' => 13,
    'blue' => 14,
];

$sum = 0;
foreach (preg_split("/\r\n|\n|\r/", $input) as $loop => $sentence) {
    [$id_string, $cubes_string] = explode(':', $sentence);

    $id = (int) filter_var($id_string, FILTER_SANITIZE_NUMBER_INT);

    $cubes = preg_split('/[;,]/', $cubes_string);

    $can_count = true;
    foreach ($cubes as $cube) {
        [$amount, $color] = explode(' ', trim($cube));

        if ($amount > $maxes[$color]) {
            $can_count = false;
        }
    }

    if ($can_count) {
        $sum += $id;
    }
}
echo $sum . PHP_EOL;

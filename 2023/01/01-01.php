<?php

$input = file_get_contents('./input.txt');

$sum = 0;
foreach (preg_split("/\r\n|\n|\r/", $input) as $loop => $sentence) {
    $collection = [];

    $letters = str_split($sentence);

    foreach ($letters as $index => $letter) {
        if (is_numeric($letter)) {
            $collection[] = (int) $letter;
        }
    }

    $first = $collection[0];
    $last = end($collection);

    $sum += (int) "$first$last";
}

echo $sum;

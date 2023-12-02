<?php

$input = file_get_contents('./input.txt');

$numbers = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
    'five' => 5,
    'six' => 6,
    'seven' => 7,
    'eight' => 8,
    'nine' => 9,
];

$sum = 0;
foreach (preg_split("/\r\n|\n|\r/", $input) as $loop => $sentence) {
    $collection = [];

    $letters = str_split($sentence);

    $str_length = strlen($sentence);

    foreach ($letters as $index => $letter) {

        if (is_numeric($letter)) {
            $collection[] = (int) $letter;
        } else {
            $word = '';
            for ($i = $index; $i < $str_length; $i++) {
                $word .= $letters[$i];

                if (array_key_exists($word, $numbers)) {
                    $collection[] = $numbers[$word];
                    $word = '';
                    break;
                }
            }
        }
    }

    $first = $collection[0];
    $last = end($collection);

    $sum += (int) "$first$last";
}

echo $sum;
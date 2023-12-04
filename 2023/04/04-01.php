<?php

$input = file_get_contents('./input.txt');

$sum = 0;
foreach (preg_split("/\r\n|\n|\r/", $input) as $loop => $line) {
    [$winning_numbers, $numbers] = explode('|', $line);

    [, $winning_numbers] = explode(': ', $winning_numbers);

    $winning_numbers = explode(' ', $winning_numbers);
    $numbers = explode(' ', $numbers);


    $points = 0;
    foreach ($numbers as $number) {
        if (!empty($number) && in_array($number, $winning_numbers)) {
            if ($points === 0) {
                $points = 1;
                continue;
            }

            $points *= 2;
        }
    }

    $sum += $points;
}

echo $sum;

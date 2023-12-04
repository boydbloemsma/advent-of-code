<?php

$input = file_get_contents('./input.txt');

$sum = 0;
$copies = [];
foreach (preg_split("/\r\n|\n|\r/", $input) as $loop => $line) {
    $current_card = $loop + 1;
    if (!isset($copies[$current_card])) {
        $copies[$current_card] = 0;
    }
    $amount_of_copies = $copies[$current_card];

    [$winning_numbers, $numbers] = explode('|', $line);

    [, $winning_numbers] = explode(': ', $winning_numbers);

    $winning_numbers = explode(' ', $winning_numbers);
    $numbers = explode(' ', $numbers);


    $wins_per_line = 0;
    foreach ($numbers as $number) {
        if (!empty($number) && in_array($number, $winning_numbers)) {
            $wins_per_line++;
        }
    }

    for ($x = 0; $x <= $amount_of_copies; $x++) {
        for ($i = 1; $i <= $wins_per_line; $i++) {
            if (!isset($copies[$current_card + $i])) {
                $copies[$current_card + $i] = 0;
            }
            $copies[$current_card + $i]++;
        }
    }
}

$cards = [];
foreach ($copies as $card => $copy) {
    $cards[$card] = $copy + 1;
}

$sum = array_sum($cards);

echo $sum;

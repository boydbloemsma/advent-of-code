<?php

$input = file_get_contents('./input.txt');

$chars = [
    '*','+','&','=','$','@','/','-','%','#',
];

$sum = 0;
$lines = preg_split("/\r\n|\n|\r/", $input);
foreach ($lines as $loop => $line) {
    $previous_loop = $loop - 1;
    $next_loop = $loop + 1;

    foreach (str_split($line) as $char_index => $char) {
        if (in_array($char, $chars)) {
            $numbers = [];
            $string_length = strlen($line);

            $coordinates_done = [];

            for ($i = $loop - 1; $i <= $loop + 1; $i++) {
                $coordinates_done[$i] = [];
                for ($x = $char_index - 1; $x <= $char_index + 1; $x++) {
                    if (is_numeric($lines[$i][$x])) {
                        $number = '';
                        $go_back = $x;
                        while (
                            is_numeric($lines[$i][$go_back])
                            && !in_array($go_back, $coordinates_done[$i])
                        ) {
                            $number = $lines[$i][$go_back] . $number;

                            $coordinates_done[$i][] = $go_back;

                            $go_back--;
                        }

                        $go_forward = $x + 1;
                        while (
                            isset($lines[$i][$go_forward])
                            && is_numeric($lines[$i][$go_forward])
                            && !in_array($go_forward, $coordinates_done[$i])
                        ) {
                            $number = $number . $lines[$i][$go_forward];

                            $coordinates_done[$i][] = $go_forward;

                            $go_forward++;
                        }

                        if (!empty($number)) {
                            $numbers[] = $number;
                        }
                    }
                }
            }

            $sum += array_sum($numbers);
        }
    }
}

echo $sum;

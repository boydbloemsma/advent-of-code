<?php

$input = file_get_contents('./input.txt');

$seeds = [];
$block = [];
$blocks = [];
$lines = preg_split("/\r\n|\n|\r/", $input);

foreach ($lines as $loop => $line) {
    if ($loop === 0) {
        // the seeds

        $seeds = explode(' ', $line);
        array_shift($seeds);

        continue;
    }

    if (empty($line) || $loop === array_key_last($lines)) {
        if ($loop !== 1) {
            $blocks[] = $block;
        }
        // end of block
        $block = [];
    } else {
        $block[] = $line;

    }
}

$mapping = [];
foreach ($blocks as $block_index => $block_lines) {
    foreach ($block_lines as $index => $block_line) {
        if ($index === 0) continue;

        [$destination_range_start, $source_range_start, $range_length] = explode(' ', $block_line);

        $mapping[$block_index][] = [
            'destination' => (int) $destination_range_start,
            'source' => (int) $source_range_start,
            'range' => (int) $range_length,
        ];
    }
}

$locations = [];
$next_item = null;
foreach ($seeds as $seed) {
    $next_item = (int) $seed;

    foreach ($mapping as $map) {
        $done = false;
        foreach ($map as $item) {
            if ($done) continue;
            if ($next_item >= $item['source'] && $next_item <= ($item['source'] + $item['range'])) {
                $diff = $next_item - $item['source'];

                $next_item = $item['destination'] + $diff;
                $done = true;
            }
        }
    }

    $locations[] = $next_item;
}

echo min($locations);
die;
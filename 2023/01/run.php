<?php

$lines = 0;
$total = 0;
$numbers = [];
foreach(\file('input') as $scrambledLine) {
    $lines++;
    $digit = \preg_replace(
        '/[a-z\s]{0,}/',
        '',
        $scrambledLine
    );

    $firstAndLast = substr($digit, 0, 1);
    $firstAndLast .= substr($digit, -1, 1);
    $numbers[$lines] = $firstAndLast;
    $total += (int) $firstAndLast;
}

echo "\r\nFirst part: $total from $lines lines.\r\n";

$replaceWordDigits = [
    'one' => 'one1one',
    'two' => 'two2two',
    'three' => '3',
    'four' => '4',
    'five' => '5',
    'six' => '6',
    'seven' => '7',
    'eight' => '8',
    'nine' => '9',
];

$lines = 0;
$total = 0;
foreach(\file('input') as $scrambledLine) {
    $lines++;
    $digit = \preg_replace(
        '/[a-z\s]{0,}/',
        '',
        $replacedWordsWithDigits = str_replace(
            \array_keys($replaceWordDigits),
            \array_values($replaceWordDigits),
            $scrambledLine
        )
    );

    $firstAndLast = substr($digit, 0, 1);
    $firstAndLast .= substr($digit, -1, 1);
    $total += (int) $firstAndLast;
}

echo "\r\nSecond part: $total from $lines lines.\r\n";

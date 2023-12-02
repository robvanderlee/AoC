<?php

interface DayInterface
{
    /** Will run both parts of the puzzle */
    public function run(): void;

    /** Will put something out to the console */
    public function output(string $message): void;

    /** The first part of the puzzle */
    public function part1(): void;

    /** The second part of the puzzle */
    public function part2(): void;
}
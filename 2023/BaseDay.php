<?php

require_once 'DayInterface.php';

class BaseDay implements DayInterface
{
    private readonly int $day;

    public function run(): void
    {
        $this->output('Running part 1...');
        $this->part1();
        try {
            $this->part2Test();
        } catch (Exception) {
            // Do nothing
        }
        $this->output('Running part 2...');
        $this->part2();
    }

    public function output(string $message): void
    {
        print \sprintf(
            '[%s] %s %s',
            \date('Y-m-d H:i:s', \time()),
            $message,
            "\r\n",
        );
    }

    public function TestItterator(): array
    {
        return $this->InputItterator(true);
    }

    public function InputItterator(bool $isTest = false): array
    {
        $replaceRegex = [
            '/[\n]{0,}/m' => '',
        ];

        $file = $isTest ? '/test' : '/input';

        $input = \array_filter(\file(getcwd() . $file));
//        \array_walk(
//            $input,
//            fn($value, $key) => \preg_replace(
//                \array_keys($replaceRegex),
//                \array_values($replaceRegex),
//                $value
//            ),
//        );
        foreach ($input as $key => $value) {
            if (\trim($value) === '') {
                unset($input[$key]);
            }

            $input[$key] = \preg_replace(
                \array_keys($replaceRegex),
                \array_values($replaceRegex),
                $value
            );
        }

        return $input;
    }

    public function part1(): void
    {
        throw new \Exception('Not implemented yet!');
    }

    public function part1Test(): void
    {
        throw new \Exception('Not implemented yet!');
    }

    public function part2(): void
    {
        throw new \Exception('Not implemented yet!');
    }

    public function part2Test(): void
    {
        throw new \Exception('Not implemented yet!');
    }
}
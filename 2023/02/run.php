<?php

require_once '../BaseDay.php';

class Day2 extends BaseDay
{
    private array $validGameBags = [];

    public function processGameData(bool $isTest = false): array
    {
        $games = [];
        $itterator = $isTest ? $this->TestItterator() : $this->InputItterator();
        foreach ($itterator as $input) {
            $gameData = \explode(':', $input);
            foreach (explode(';', $gameData[1]) as $index => $game) {
                $game = explode(',', $game);
                $sets = \array_map(
                    fn($value) => \trim($value),
                    $game,
                );
                foreach ($sets as $set) {
                    $setData = \explode(' ', $set);
                    $games[preg_replace('/[a-zA-Z\s]{0,}/m', '', $gameData[0])][$index][$setData[1]] = (int) $setData[0];
                }
            }
        }

        return $games;
    }

    public function procesSampleData(): array
    {
        return $this->processGameData(true);
    }

    public function isGameValid(array $bags): bool
    {
        $criteria = [
            'red' => 12,
            'green' => 13,
            'blue' => 14,
        ];

        foreach ($bags as $bag) {
            $red = \key_exists('red', $bag) ? $bag['red'] : 0;
            $green = \key_exists('green', $bag) ? $bag['green'] : 0;
            $blue = \key_exists('blue', $bag) ? $bag['blue'] : 0;

            if ($criteria['red'] < $red || $criteria['green'] < $green || $criteria['blue'] < $blue) {
                return false;
            }
        }

        return true;
    }

    public function part1(): void
    {
        $games = $this->processGameData();

        $validGamesSum = [];
        foreach ($games as $game => $bags) {
            if ($this->isGameValid($bags)) {
                $this->output(\sprintf('GAME FOUND! Game %d.', $game));
                $validGamesSum[] = $game;
                // Preparate for part 2
                $this->validGameBags[$game] = $bags;
            }
        }

        $this->output(\sprintf('The sum of valid game ids is %d', \array_sum($validGamesSum)));
    }

    public function part2Test(): void
    {
        $sum = 0;
        foreach ($this->procesSampleData() as $game => $bags) {
            $red = [0];
            $green = [0];
            $blue = [0];

            foreach ($bags as $bag) {
                foreach ($bag as $color => $value) {
                    switch ($color) {
                        case 'red': $red[] = $value; break;
                        case 'green': $green[] = $value; break;
                        case 'blue': $blue[] = $value; break;
                    }
                }
            }

            $sum += $power = max($red) * max($green) * max($blue);
        }

        \assert($sum === 2286);
    }

    public function part2(): void
    {
        $sum = 0;
        foreach ($this->processGameData() as $game => $bags) {
            $red = [];
            $green = [];
            $blue = [];

            foreach ($bags as $bag) {
                foreach ($bag as $color => $value) {
                    switch ($color) {
                        case 'red': $red[] = $value; break;
                        case 'green': $green[] = $value; break;
                        case 'blue': $blue[] = $value; break;
                    }
                }
            }

            $sum += $power = max($red) * max($green) * max($blue);
            $this->output(\sprintf(
                'Game %d has %d possibilities. Sum so far %d',
                $game,
                $power,
                $sum
            ));
        }

        $this->output(\sprintf('The sum of possiblilities of these games %d', $sum));
    }
}

(new Day2())->run();
<?php

namespace App\Services;

class SortingService
{
    private const CYWARORDER = [
        'a', 'b', 'd', 'h', 'v',
        'g', 'z', 'j', 't', 'y',
        'o', 'k', 'n', 'm', 's',
        'i', 'l', 'p', 'x', 'q',
        'w', 'u', 'c', 'r', 'e',
        'f'
    ];

    private $input;

    public function __construct($inputString)
    {
        $this->input = $this->prepareInput($inputString);
    }

    public function sort(): string
    {
        usort($this->input, function ($a, $b) {
            for ($i = 0; $i < min(strlen($a), strlen($b)); $i++) {
                if ($a[$i] != $b[$i]) {
                    $positionAInAlphabet = array_search($a[$i], self::CYWARORDER);
                    $positionBInAlphabet = array_search($b[$i], self::CYWARORDER);

                    $difference = $positionAInAlphabet <=> $positionBInAlphabet;

                    if ($difference == 0) {
                        continue;
                    }

                    return $difference;
                }
            }

            return strlen($b) <=> strlen($a);
        });

        return implode(' ', $this->input);
    }


    private function prepareInput($rawInput): array
    {
        $withoutPunctuation = preg_replace('/[^a-z0-9]+/i', ' ', $rawInput);
        $lowerCased = strtolower($withoutPunctuation);
        return explode(' ', $lowerCased);
    }
}

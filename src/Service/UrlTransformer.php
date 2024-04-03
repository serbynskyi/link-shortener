<?php

namespace App\Service;

class UrlTransformer
{
    const BASE = 40;

    const ALLOWED_CHARS = [
        1 => 'a',
        2 => 'b',
        3 => 'c',
        4 => 'd',
        5 => 'e',
        6 => 'f',
        7 => 'g',
        8 => 'h',
        9 => 'i',
        10 => 'j',
        11 => 'k',
        12 => 'l',
        13 => 'm',
        14 => 'n',
        15 => 'o',
        16 => 'p',
        17 => 'q',
        18 => 'r',
        19 => 's',
        20 => 't',
        21 => 'u',
        22 => 'v',
        23 => 'w',
        24 => 'x',
        25 => 'y',
        26 => 'z',
        27 => '0',
        28 => '1',
        29 => '2',
        30 => '3',
        31 => '4',
        32 => '5',
        33 => '6',
        34 => '7',
        35 => '8',
        36 => '9',
        37 => '-',
        38 => '_',
        39 => '.',
        0 => '~'
    ];

    public function convertToUniqueString(int $id): string
    {
        $result = '';
        while ($id > 0) {
            $remainder = $id % self::BASE;
            $result = self::ALLOWED_CHARS[$remainder] . $result;
            $id = intdiv($id, self::BASE);
        }

        return $result;
    }
}
<?php

namespace Models;

class StringHelper
{
    public function containsSymbols(string $input):bool {
        $stringAsArray = str_split($input);

        foreach ($stringAsArray as $value) {
            if (!is_numeric($value) && !ctype_alpha($value)) {
                return true;
            }
        }

        return false;
    }

    public function containsNumbers(string $input):bool {
        $stringAsArray = str_split($input);

        foreach ($stringAsArray as $value) {
            if (is_numeric($value)) {
                return true;
            }
        }

        return false;
    }
}
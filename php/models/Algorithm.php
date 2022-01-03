<?php

namespace Models;

require_once(realpath(dirname(__FILE__, 1) . "\StringHelper.php"));
require_once(realpath(dirname(__FILE__, 1) . "\TextCompressionException.php"));

class Algorithm
{
    public function compress(string $input):string {

        if ($input == null) {
            throw new TextCompressionException("Invalid input string - input cannot be null.");
        }

        $stringHelper = new StringHelper();

        if ($stringHelper->containsSymbols($input) || $stringHelper->containsNumbers($input)) {
            throw new TextCompressionException("Invalid input string - input contains invalid characters.");
        }

        $output = "";
        $repeatedChar = ' ';

        for ($i = 0; $i < strlen($input);) {
            $repeatedChar = $input[$i];

            $repeatedCharCount = 0;

            for ($j = $i; $j < strlen($input); $j++) {
                if ($input[$j] != $repeatedChar) {
                    break;
                }

                $repeatedCharCount++;
                $i++;
            }

            $output = $output . $repeatedChar . $repeatedCharCount;
        }

        if (empty($output)) {
            throw new TextCompressionException("Invalid input string - input was empty.");
        }

        return $output;
    }

    public function decompress(string $input):string {

        if ($input == null) {
            throw new TextCompressionException("Invalid input string - input cannot be null.");
        }

        $stringHelper = new StringHelper();

        if ($stringHelper->containsSymbols($input) || !$stringHelper->containsNumbers($input)) {
            throw new TextCompressionException("Invalid input string - input contains invalid characters.");
        }

        $output = "";
        $repeatedChar = '';
        $repeatedCharCount = -1;

        for ($i = 0; $i < strlen($input);) {

            $tempChar = $input[$i];

            if (!is_numeric($tempChar)) {
                $repeatedChar = $tempChar;
                $i++;
            }
            else {
                $totalRepeatedCountString = "";

                for ($j = $i; $j < strlen($input); $j++) {
                    if (!is_numeric($input[$j])) {
                        break;
                    }

                    $totalRepeatedCountString = $totalRepeatedCountString . $input[$j];
                }

                $repeatedCharCount = intval($totalRepeatedCountString);

                if ($repeatedCharCount == 0) {
                    throw new TextCompressionException("Invalid number in input string - one of the numbers was 0.");
                }

                for ($k = 0; $k < $repeatedCharCount; $k++) {
                    $output = $output . $repeatedChar;
                }

                $i += strlen($totalRepeatedCountString);
            }
        }

        if (empty($output)) {
            throw new TextCompressionException("Invalid input string - input was empty.");
        }

        return $output;
    }

    public function isStringCompressed(string $inputText):bool {
        $stringHelper = new StringHelper();

        if ($stringHelper->containsSymbols($inputText)) {
            throw new TextCompressionException("Non-alphanumeric character found in input string.");
        }
        else
            return $stringHelper->containsNumbers($inputText);
    }
}
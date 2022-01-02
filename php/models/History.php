<?php

class History
{
    public array $history;

    public function __construct()
    {
        $this->history = array();
    }

    public function add(string $input, string $output) {

        if ($input == null) {
            throw new TextCompressionException("History input (key) cannot be null!");
        }

        $entry = [$input, $output];

        $this->history[] = $entry;
    }

    public function getEntryByIndex(int $index) {

        if ($index<0) {
            throw new TextCompressionException("Index cannot be less than 0 !");
        }

        if ($index >= count($this->history)) {
            throw new TextCompressionException("Requested index was outside of collection bounds!");
        }

        return $this->history[$index];
    }

    public function getEntryOutputByInput(string $input):string {
        if ($input == null) {
            throw new TextCompressionException("Provided input value cannot be null!");
        }

        for ($i = 0; $i < count($this->history); $i++) {
            $entry = $this->history[$i];

            if ($entry[0] == $input) {
                return $entry[1];
            }
        }

        return "";
    }
}
<?php

namespace Controllers;

use Models\Algorithm;
use Models\History;
use Models\TextCompressionException;

require_once(realpath(dirname(__FILE__, 2)) . "\models\Algorithm.php");
require_once(realpath(dirname(__FILE__, 2)) . "\models\History.php");

$history = new History();

if($_SERVER['REQUEST_METHOD'] == "POST")  {
    $input = $_POST["input"];

    performAlgorithm($input);
}
else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    showHistory();
}

function performAlgorithm(string $input) {

    global $history;

    if (strlen($input) == 0) {
        echo "Input parameter cannot be empty!";
    }

    $algorithm = new Algorithm();
    $output = "";

    try {
        $isInputCompressed = $algorithm->isStringCompressed($input);

        if ($isInputCompressed) {
            $output = $algorithm->decompress($input);
        }
        else {
            $output = $algorithm->compress($input);
        }

        echo "Algorithm output is: <b>$output</b>";

        $history->add($input, $output);
    }
    catch (TextCompressionException $ex) {
        echo strval($ex);
    }
}

function showHistory() {

    global $history;

    echo "<b>HISTORY</b><br/>";

    for ($i = 0; $i < $history->getHistorySize(); $i++) {
        try {
            $entry = $history->getEntryByIndex($i);

            echo "Input: $entry[0]; Output: $entry[1] <br/>";
        }
        catch (TextCompressionException $ex) {
            break;
        }
    }

}
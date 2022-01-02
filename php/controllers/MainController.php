<?php

require_once("C:\Programowanie\TextCompressionWeb\php\models\Algorithm.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $input = $_POST["input"];

    performAlgorithm($input);
}

function performAlgorithm(string $input) {

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

    }
    catch (TextCompressionException $ex) {
        echo strval($ex);
    }
}
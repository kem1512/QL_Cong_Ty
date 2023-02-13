<?php
// Enter your code here, enjoy!

function find_consecutive($array, $count) {
    $consecutive = array();
    $previous = null;
    foreach ($array as $value) {
        if ($previous !== null && $value == $previous + 1) {
            $consecutive[] = $value;
            if ($found == $count) {
                return "I found it: " . implode("|", $consecutive) . "<br>";
            }
        } else {
            $consecutive = array($value);
            $found = 1;
        }
        $previous = $value;
        $found++;
    }
}

$number = array(9, 10, 11);
echo find_consecutive($number, 4);

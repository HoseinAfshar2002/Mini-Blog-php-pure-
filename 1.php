<?php

$convert = json_decode($testJson);
print_r($convert);
echo "<hr>";
echo $convert->query="197.168.1.1";
echo "<hr>";
print_r($convert);
echo "<hr>";

$v = json_encode($convert);
echo $v;
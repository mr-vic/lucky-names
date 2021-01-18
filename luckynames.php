<?php

$data = [];
if (($handle = fopen("names.csv", "r")) !== FALSE) {
    $data = fgetcsv($handle, $lenght = 0, $delimiter = ";");
    fclose($handle);
}



echo "<pre>";
print_r($data);
echo "</pre>";
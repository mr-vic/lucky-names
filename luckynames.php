<?php
// Количество выводимых имен за раз
$limit_names = 3;
// Название файла csv
$csv_file = "names.csv";
// Массив для исходных данных
$data = [];
// Двумерный массив с именами
$names = [];

// Считываем данные из файла имен .csv в массив $data
if (($handle = fopen($csv_file, "r")) !== FALSE) {
    $data = fgetcsv($handle, $lenght = 0, $delimiter = ";");
    fclose($handle);
}

// Заполняем двумерный массив с именами
for ($i = 0; $i < ceil(count($data) / $limit_names); $i++){
    for ($index = 0; $index < $limit_names; $index++){
        $names[$i][] = current($data);
        next($data);
    }
}


// Считываем файл с праздничными днями в массив $holiday
// реализовать в будущем

echo "<pre>";
print_r($names);
echo "</pre>";

echo "<pre>";
print_r($data);
echo "</pre>";

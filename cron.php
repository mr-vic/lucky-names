<?php
// Количество выводимых имен за раз
$limit_names = 3;
// Название файла csv
$csv_file = "names.csv";
// Название файла с выбранными данными в формате json
$save_file = "current_names";
// Массив для исходных данных
$data = [];
// Массив для отобранных имен
$names = [];

// Считываем данные из файла имен .csv в массив $data
if (($handle = fopen($csv_file, "r")) !== FALSE) {
    $data = fgetcsv($handle, $lenght = 0, $delimiter = ";");
    fclose($handle);
}

// Выбираем три случайных имени
for ($i = 0; $i < $limit_names; $i++){
    $names[] = $data[rand(0, count($data)-1)];
}

// Сохраняем массив в файл $save_file
$save_data = json_encode($names);
file_put_contents(dirname(__FILE__) . "/" . $save_file . ".json", $save_data);

/* echo dirname(__FILE__) . "/" . $save_file . ".json" . "<br>";

echo "<pre>";
print_r($names);
echo "</pre>";

echo "<pre>";
print_r($data);
echo "</pre>";
 */
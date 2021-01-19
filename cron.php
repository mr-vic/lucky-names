<?php
// Количество выводимых имен за раз
$limit_names = 3;
// Название файла csv
$csv_file = "names.csv";

/* // Название файла с выбранными данными в формате json
$save_file = "current_names"; */

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

/* // Сохраняем массив в файл $save_file
$save_data = json_encode($names);
file_put_contents(dirname(__FILE__) . "/" . $save_file . ".json", $save_data);

// Получаем массив имен
$file_name = "current_names";
$data = file_get_contents(dirname(__FILE__) . "/" . $file_name . ".json");
$names = json_decode($data); */
// Шрифт для надписей 
$font = __DIR__ . '/arialbd.ttf';
// Текущая дата 
$today = date("d.m.Y");
// Размер скидки
$discount = '20%';
// Путь к файлу шаблону картинки 
$image_file = __DIR__ . '/template.jpeg';

for ($i = 0; $i < $limit_names; $i++){

    // Текущее имя 
    $current_name = $names[$i];
    // Имя файла обработанного изображения 
    $file_jpeg = "ln_$i.jpg";
    // Читаем картинку с шаблонов в ресурс 
    $image_template = imagecreatefromjpeg($image_file);
    // Вычисляем цвет для текста 
    $color = imagecolorexact($image_template, 246, 208, 0);

    // Ширина картинки 
    $image_width = imagesx($image_template);
    // Ширина текста с Именем
    $text_box = imagettfbbox(36, 0, $font, $current_name);
    $text_width = $text_box[2]-$text_box[0];

    // Выводим на картинке дату, % скидки, и Имя счастливчика по центру изображения 
    imagefttext($image_template, 22, 0, 225, 200, $color, $font, $today);
    imagefttext($image_template, 26, 0, 165, 245, $color, $font, $discount);
    imagefttext($image_template, 36, 0, ($image_width / 2) - ($text_width / 2), 420, $color, $font, $current_name);

    // Сохраняем обработанное изображение 
    imagejpeg($image_template, $file_jpeg);
    // Освобождаем память 
    imagedestroy($image_template);

}
// echo dirname(__FILE__) . "/" . $save_file . ".json" . "<br>";

/* echo "<pre>";
print_r($names);
echo "</pre>";

echo "<pre>";
print_r($data);
echo "</pre>"; */
 
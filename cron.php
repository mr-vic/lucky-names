<?php
// Количество выводимых имен за раз
$limit_names = 3;
// Название файла csv
$csv_file = __DIR__ . '/data/names.csv';
// Массив для исходных данных
$data = [];
// Массив для отобранных имен
$names = [];
// Шрифт для надписей 
$font = __DIR__ . '/font/main.ttf';
// Текущая дата 
$today = date("d.m.Y");
// Размер скидки
$discount = '20%';
// Путь к файлу шаблону картинки 
$image_file = __DIR__ . '/template/main.jpeg';

// Считываем данные из файла имен .csv в массив $data
if (($handle = fopen($csv_file, "r")) !== FALSE) {
    $data = fgetcsv($handle, $lenght = 0, $delimiter = ";");
    fclose($handle);
}

for ($i = 0; $i < $limit_names; $i++){
    // Выбираем случайное имя
    $names[] = $data[rand(0, count($data)-1)];
    // Текущее имя 
    $current_name = $names[$i];
    // Имя файла обработанного изображения 
    $file_jpeg = __DIR__ . "/out/lnimage$i". date("d.m.Y") .".jpg";
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
 
<?php

/* Получаем массив имен */
$file_name = "current_names";
$data = file_get_contents(dirname(__FILE__) . "/" . $file_name . ".json");
$names = json_decode($data);
/* Шрифт для надписей */
$font = __DIR__ . '/arialbd.ttf';
/* Текущая дата */
$today = "20.01.2021";
/* Путь к файлу шаблону картинки */
$image_file = __DIR__ . '/template.jpeg';
/* Текущее имя */
$current_name = $names[0];
/* Читаем картинку с шаблонов в ресурс */
$image_template = imagecreatefromjpeg($image_file);
header('Content-Type: image/jpg');
/* Вычисляем цвет для текста */
$color = imagecolorexact($image_template, 246, 208, 0);

/* Ширина картинки */
$image_width = imagesx($image_template);
/* Ширина текста с Именем*/
$text_box = imagettfbbox(36, 0, $font, $current_name);
$text_width = $text_box[2]-$text_box[0];

/* Выводим на картинке дату, % скидки, и Имя счастливчика */
imagefttext($image_template, 22, 0, 225, 200, $color, $font, '20.01.2021');
imagefttext($image_template, 26, 0, 165, 245, $color, $font, '30%');
imagefttext($image_template, 36, 0, ($image_width / 2) - ($text_width / 2), 420, $color, $font, $current_name);


imagejpeg($image_template);
/* header('Content-Type: image/jpg'); */
/* imagejpeg($image_template); */
imagedestroy($image_template);

/* echo "<pre>";
print_r($names);
echo "</pre>"; */
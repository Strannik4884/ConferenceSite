<?php
    // путь до файла конфигураций
    $path = "../config/file_types.ini";
    // если не нашли файл конфигураций
    if (!is_file($path)) {
        // поднимаемся на папку выше
        $path = "../" . $path;
        // если и там не нашли - ошибка
        if (!is_file($path)) {
            print "Ошибка: Директория конфигураций не найдена!" . "<br/>";
            die();
        }
    }
    // парсим главный файл конфигураций
    $ini_array = parse_ini_file($path, true);
    // проверяем наличие необходимых переменных в файле конфигураций
    if(!isset($ini_array['text_types']) || !isset($ini_array['presentation_types'])) {
        print "Ошибка: Файл конфигураций повреждён!" . "<br/>";
        die();
    }
    // если все переменные на месте
    // получаем массив с разрешеннами типами файлов для текста выступления
    $file_text_types = array();
    foreach ($ini_array['text_types'] as $key => $value){
        array_push($file_text_types, $value);
    }
    // получаем массив с разрешеннами типами файлов для презентации
    $file_presentation_types = array();
    foreach ($ini_array['presentation_types'] as $key => $value){
        array_push($file_presentation_types, $value);
    }
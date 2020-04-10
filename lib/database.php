<?php
    // путь до файла конфигураций
    $path = "../config/server.ini";
    // если не нашли файл конфигураций
    if(!is_file($path)) {
        // поднимаемся на папку выше
        $path = "../".$path;
        // если и там не нашли - ошибка
        if(!is_file($path)){
            print "Ошибка: Директория конфигураций не найдена!" . "<br/>";
            die();
        }
    }
    // парсим главный файл конфигураций
    $ini_array = parse_ini_file($path, true);
    // проверяем наличие необходимых переменных в файле конфигураций
    if(!isset($ini_array['db']['host']) || !isset($ini_array['db']['dbname']) || !isset($ini_array['db']['user']) || !isset($ini_array['db']['password'])) {
        print "Ошибка: Файл конфигураций повреждён!" . "<br/>";
        die();
    }
    // проверяем переменные на пустоту
    if(empty($ini_array['db']['host']) || empty($ini_array['db']['dbname']) || empty($ini_array['db']['user'])) {
        print "Ошибка: Настройте конфигурацию сервера!" . "<br/>";
        die();
    }
    // строка подключения
    $dsn = "pgsql:host={$ini_array['db']['host']};dbname={$ini_array['db']['dbname']}";
    // настройки подключения
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    // пробуем подключиться к базе данных
    try {
        $connection = new PDO($dsn, $ini_array['db']['user'], $ini_array['db']['password'], $options);
    } catch (PDOException $e) {
        print "Ошибка: " . $e->getMessage() . "<br/>";
        die();
    }
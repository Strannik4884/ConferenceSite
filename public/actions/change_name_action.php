<?php
    session_start();
    require_once("../../lib/database.php");
    // устанавливаем в форму все введенные значения
    foreach ($_POST as $key => $value){
        if(isset($value)){
            $_SESSION[$key] = $value;
        }
    }
    // проверяем обязательные поля на пустоту
    if(empty($_POST['name'])){
        $_SESSION['error_message'] = 'Все поля должны быть заполнены!';
        header('Location: ../profile?action=change_name');
    }
    // проверяем ФИО на корректный ввод
    else if(!preg_match('/^[АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ][-абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ ]+$/u', $_POST['name'])){
        $_SESSION['error_message'] = 'ФИО должно начинаться с заглавной буквы и состоять из русских букв, пробелов и дефисов!';
        header('Location: ../profile?action=change_name');
    }
    // если все проверки пройдены
    else {
        // обновляем ФИО пользователя
        $prepared = $connection->prepare("UPDATE \"user\" SET user_name = :name where user_id = :id");
        $prepared->execute([$_POST['name'], $_SESSION['logged_user']['user_id']]);
        $_SESSION['info_message'] = 'ФИО успешно изменено!';
        // обновляеме у текущего пользователя данные
        $_SESSION['logged_user']['user_name'] = $_POST['name'];
        // возвращаемся обратно
        header('Location: ../profile?action=change_name');
    }
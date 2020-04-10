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
    if(empty($_POST['position'])){
        $_SESSION['error_message'] = 'Все поля должны быть заполнены!';
        header('Location: ../profile?action=change_position');
    }
    // если все проверки пройдены
    else {
        // обновляем должность пользователя
        $prepared = $connection->prepare("UPDATE \"user\" SET user_position = :position where user_id = :id");
        $prepared->execute([$_POST['position'], $_SESSION['logged_user']['user_id']]);
        $_SESSION['info_message'] = 'Должность успешно изменена!';
        // обновляеме у текущего пользователя данные
        $_SESSION['logged_user']['user_position'] = $_POST['position'];
        // возвращаемся обратно
        header('Location: ../profile?action=change_position');
    }
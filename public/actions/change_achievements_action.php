<?php
    session_start();
    require_once("../../lib/database.php");
    // устанавливаем в форму все введенные значения
    foreach ($_POST as $key => $value){
        if(isset($value)){
            $_SESSION[$key] = $value;
        }
    }
    // обновляем должность пользователя
    $prepared = $connection->prepare("UPDATE \"user\" SET user_achievements = :achievements where user_id = :id");
    $prepared->execute([$_POST['achievements'], $_SESSION['logged_user']['user_id']]);
    $_SESSION['info_message'] = 'Достижения успешно изменены!';
    // обновляеме у текущего пользователя данные
    $_SESSION['logged_user']['user_achievements'] = $_POST['achievements'];
    // возвращаемся обратно
    header('Location: ../profile?action=change_achievements');
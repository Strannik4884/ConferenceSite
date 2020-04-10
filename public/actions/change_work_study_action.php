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
    if(empty($_POST['work_study'])){
        $_SESSION['error_message'] = 'Все поля должны быть заполнены!';
        header('Location: ../profile?action=change_work_study');
    }
    // если все проверки пройдены
    else {
        // обновляем место работы/учёбы пользователя
        $prepared = $connection->prepare("UPDATE \"user\" SET user_work_study = :work_study where user_id = :id");
        $prepared->execute([$_POST['work_study'], $_SESSION['logged_user']['user_id']]);
        $_SESSION['info_message'] = 'Место работы/учёбы успешно изменено!';
        // обновляеме у текущего пользователя данные
        $_SESSION['logged_user']['user_work_study'] = $_POST['work_study'];
        // возвращаемся обратно
        header('Location: ../profile?action=change_work_study');
    }
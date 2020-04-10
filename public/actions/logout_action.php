<?php
    session_start();
    // если пользователь в сессии - удаляем
    if(isset($_SESSION['logged_user'])) {
        unset($_SESSION['logged_user']);
        header('Location: ../login');
    }
    // иначе возвращаемся обратно
    else {
        if(isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else{
            header('Location: /');
        }
    }
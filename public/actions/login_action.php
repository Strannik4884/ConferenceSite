<?php
    session_start();
    require_once("../../lib/database.php");
    // устанавливаем в форму логин, если он был введён
    if(isset($_POST['login'])){
        $_SESSION['login'] = $_POST['login'];
    }
    // проверяем логин и пароль на пустоту
    if(empty($_POST['login']) || empty($_POST['password'])){
        $_SESSION['error_message'] = 'Заполните все поля!';
        header('Location: ../login');
        die();
    }
    // если все данные введены
    else {
        // проверяем, есть ли пользователь с такими данными
        $prepared = $connection->prepare("SELECT * FROM account WHERE account_login = :login");
        $prepared->execute([$_POST['login']]);
        $account = $prepared->fetch();
        // если записей не найдено - возвращаем ошибку
        if ($prepared->rowCount() != 1) {
            $_SESSION['error_message'] = 'Неверный логин или пароль!';
            header('Location: ../login');
            die();
        }
        // если у найденной записи пароль не совпадает - возвращаем ошибку
        else if (!password_verify($_POST['password'], $account['account_password'])) {
            $_SESSION['error_message'] = 'Неверный логин или пароль!';
            header('Location: ../login');
            die();
        }
        // если проверки пройдены - удаляем все переменные из сессии
        else {
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            // если входит админ
            if(strcmp($account['account_role'], 'admin') == 0){
                $_SESSION['logged_user'] = $account;
                header('Location: ../request');
            }
            // если обычный пользователь
            else {
                // получаем данные пользователя
                $prepared = $connection->prepare("SELECT * FROM \"user\" WHERE account_login = :login");
                $prepared->execute([$_POST['login']]);
                // устанавливаем сессию
                $_SESSION['logged_user'] = $prepared->fetch();
                // переходим в профиль пользователя
                header('Location: ../request');
            }
        }
    }
<?php
    session_start();
    require_once("../../lib/database.php");
    // устанавливаем в форму все введенные значения, кроме пароля и подтверждения пароля
    foreach ($_POST as $key => $value){
        if(isset($value) && $key != "password" && $key != "password_confirm"){
            $_SESSION[$key] = $value;
        }
    }
    // проверяем обязательные поля на пустоту
    if(empty($_POST['name']) || empty($_POST['login']) || empty($_POST['password']) || empty($_POST['password_confirm']) || empty($_POST['work_study']) || empty($_POST['position'])){
        $_SESSION['error_message'] = 'Все поля, кроме "Достижения", должны быть заполнены!';
        header('Location: ../register.php');
    }
    // проверяем ФИО на корректный ввод
    else if(!preg_match('/^[АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ][-абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ ]+$/u', $_POST['name'])){
        $_SESSION['error_message'] = 'ФИО должно начинаться с заглавной буквы и состоять из русских букв, пробелов и дефисов!';
        header('Location: ../register.php');
    }
    // проверяем корректность ввода почты
    else if (!preg_match("/.+@.+\..+/i", $_POST['login'])) {
        $_SESSION['error_message'] = 'Некорректный email!';
        header('Location: ../register.php');
    }
    // проверка пароля на соответствие требованиям безопасности
    else if (!preg_match('/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/', $_POST['password'])) {
        $_SESSION['error_message'] = 'Пароль должен быть длинне 5 символов, состоять из латинских заглавных и строчных букв и иметь цифры и специальные символы!';
        header('Location: ../register.php');
    }
    // проверка на совпадение паролей
    else if (strcmp($_POST['password'], $_POST['password_confirm']) != 0) {
        $_SESSION['error_message'] = 'Пароли не совпадают!';
        header('Location: ../register.php');
    }
    // проверка согласия на обработку персональных данных
    else if(!isset($_POST['is_consent'])){
        $_SESSION['error_message'] = 'Для продолжения согласитесь на обработку персональных данных!';
        header('Location: ../register.php');
    }
    // если все проверки пройдены
    else{
        // проверяем, есть ли пользователь с таким логином в базе данных
        $prepared = $connection->prepare("SELECT * FROM account WHERE account_login = :login");
        $prepared->execute([$_POST['login']]);
        // если такого пользователя нет
        if($prepared->rowCount() == 0){
            // удаляем все переменные из сессии
            foreach ($_SESSION as $key => $value){
                unset($_SESSION[$key]);
            }
            // добавляем новый аккаунт
            $prepared = $connection->prepare("INSERT INTO account(account_login, account_password, account_role) VALUES(:login, :password, 'user')");
            $prepared->execute([$_POST['login'], password_hash($_POST['password'], PASSWORD_DEFAULT)]);
            // добавляем данные нового пользователя
            $prepared = $connection->prepare("INSERT INTO \"user\"(account_login, user_name, user_work_study, user_position, user_achievements) VALUES(:login, :name, :work_study, :position, :achievements)");
            $achievements = $_POST['achievements'];
            if(!isset($achievements)){
                $achievements = '';
            }
            $prepared->execute([$_POST['login'], $_POST['name'], $_POST['work_study'], $_POST['position'], $achievements]);
            // переходим на страницу входа и выводим сообщение об успешной регистрации
            $_SESSION['info_message'] = 'Пользователь успешно зарегистрирован!';
            header('Location: ../login.php');
        }
        else{
            $_SESSION['error_message'] = 'Пользователь с данной почтой уже зарегистрирован!';
            header('Location: ../register.php');
        }
    }
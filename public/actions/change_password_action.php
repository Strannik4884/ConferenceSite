<?php
    session_start();
    require_once("../../lib/database.php");
    // устанавливаем в форму все введенные значения, кроме подтверждения пароля
    foreach ($_POST as $key => $value){
        if(isset($value) && $key != "new_password_confirm"){
            $_SESSION[$key] = $value;
        }
    }
    // проверяем обязательные поля на пустоту
    if(empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['new_password_confirm'])){
        $_SESSION['error_message'] = 'Все поля должны быть заполнены!';
        header('Location: ../profile?action=change_password');
    }
    else {
        // проверяем корректность ввода старого пароля
        $prepared = $connection->prepare("SELECT account_password FROM account WHERE account_login = :login");
        $prepared->execute([$_SESSION['logged_user']['account_login']]);
        if ($prepared->rowCount() != 0) {
            // если старый пароль был введен правильно
            if (password_verify($_POST['old_password'], $prepared->fetch()['account_password'])) {
                // проверка нового пароля на соответствие требованиям безопасности
                if (!preg_match('/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/', $_POST['new_password'])) {
                    $_SESSION['error_message'] = 'Пароль должен быть длинне 5 символов, состоять из латинских заглавных и строчных букв, иметь цифры и специальные символы!';
                    header('Location: ../profile?action=change_password');
                }
                // проверка на совпадение паролей
                else if (strcmp($_POST['new_password'], $_POST['new_password_confirm']) != 0) {
                    $_SESSION['error_message'] = 'Пароли не совпадают!';
                    header('Location: ../profile?action=change_password');
                }
                // если все проверки пройдены
                else {
                    $prepared = $connection->prepare("UPDATE account SET account_password = :new_password WHERE account_login = :login");
                    $prepared->execute([password_hash($_POST['new_password'], PASSWORD_DEFAULT), $_SESSION['logged_user']['account_login']]);
                    $_SESSION['info_message'] = 'Пароль успешно изменён!';
                    header('Location: ../profile?action=change_password');
                }
            }
            else{
                $_SESSION['error_message'] = 'Действующий пароль введён некорректно!';
                header('Location: ../profile?action=change_password');
            }
        }
        else{
            $_SESSION['error_message'] = 'Некорректный логин!';
            header('Location: ../profile?action=change_password');
        }
    }
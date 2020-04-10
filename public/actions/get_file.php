<?php
    session_start();
    // блокируем доступ, если пользователь не авторизован
    if(!isset($_SESSION['logged_user'])){
        header('Location: login.php');
        die();
    }
    require_once("../../lib/database.php");
    // если было передано имя файла
    if(isset($_GET['file'])){
        // проверяем переданный файл у текущего пользователя в файлах с текстами
        $prepared = $connection->prepare("select user_id from request where user_id = :user_id and request_file_text = :file");
        $prepared->execute([$_SESSION['logged_user']['user_id'], 'uploads/' . $_GET['file']]);
        $file_name = substr($_GET['file'], strlen(time()));
        if($prepared->rowCount() != 0 && file_exists('../uploads/' . $_GET['file'])){
            header('Content-Type: ' . mime_content_type('../uploads/' . $_GET['file']));
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            readfile('../uploads/' . $_GET['file']);
        }
        else{
            $prepared = $connection->prepare("select user_id from request where user_id = :user_id and request_file_presentation = :file");
            $prepared->execute([$_SESSION['logged_user']['user_id'], 'uploads/' . $_GET['file']]);
            if($prepared->rowCount() != 0 && file_exists('../uploads/' . $_GET['file'])){
                header('Content-Type: ' . mime_content_type('../uploads/' . $_GET['file']));
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                readfile('../uploads/' . $_GET['file']);
            }
            else{
                header('Location: /404.php');
                die();
            }
        }
    }
    else{
        header('Location: /403.php');
        die();
    }

<?php
    session_start();
    require_once("../../lib/database.php");
    require ("../../lib/file_types.php");
    // устанавливаем в форму все введенные значения
    $count = 0;
    foreach ($_POST as $key => $value) {
        if (!empty($value)) {
            $_SESSION[$key] = $value;
            // считаем количество заполненных полей (кроме файлов)
            if($key != 'request_file_text' && $key != 'request_file_presentation') {
                $count++;
            }
        }
    }
    // если не все поля заполнены - ошибка
    if($count < 3){
        $_SESSION['error_message'] = 'Все поля должны быть заполнены!';
        header('Location: ../request?action=add');
        die();
    }
    // если файл с текстом выступления не загружен - ошибка
    else if(empty($_FILES['request_file_text']['tmp_name'])){
        $_SESSION['error_message'] = 'Загрузите файл с текстом выступления!';
        header('Location: ../request?action=add');
        die();
    }
    // если файл с презентацией не загружен - ошибка
    else if(empty($_FILES['request_file_presentation']['tmp_name'])) {
        $_SESSION['error_message'] = 'Загрузите файл с презентацией!';
        header('Location: ../request?action=add');
        die();
    }
    // если ошибок при заполнении формы нет
    else {
        // проверка файла с текстом выступления
        if(!in_array(mime_content_type($_FILES['request_file_text']['tmp_name']), $file_text_types)){
            $_SESSION['error_message'] = 'Текст выступления должен быть в формате doc, docx или pdf !';
            header('Location: ../request?action=add');
            die();
        }
        else if(filesize($_FILES['request_file_text']['tmp_name']) > 10485760){
            $_SESSION['error_message'] = 'Текст выступления должен быть не более 10 МБ!';
            header('Location: ../request?action=add');
            die();
        }
        // проверка файла с презентацией
        else if(!in_array(mime_content_type($_FILES['request_file_presentation']['tmp_name']), $file_presentation_types)){
            $_SESSION['error_message'] = 'Презентация должна быть в формате ppt, pptx или pdf !';
            header('Location: ../request?action=add');
            die();
        }
        else if(filesize($_FILES['request_file_presentation']['tmp_name']) > 31457280){
            $_SESSION['error_message'] = 'Презентация должна быть не более 30 МБ!';
            header('Location: ../request?action=add');
            die();
        }
        // если ошибок нет
        else{
            // грузим файлы в папку загрузок
            $path = 'uploads/' . time();
            // грузим файл с текстом, если неудачно - ошибка
            if(!move_uploaded_file($_FILES['request_file_text']['tmp_name'], '../'. $path . trim($_FILES['request_file_text']['name']))){
                $_SESSION['error_message'] = 'Ошибка при загрузке файла!';
                header('Location: ../request?action=add');
                die();
            }
            // грузим файл презентации, если неудачно - ошибка
            else if(!move_uploaded_file($_FILES['request_file_presentation']['tmp_name'], '../'. $path . trim($_FILES['request_file_presentation']['name']))){
                $_SESSION['error_message'] = 'Ошибка при загрузке файла!';
                header('Location: ../request?action=add');
                die();
            }
            // если все файлы успешно загружены
            else {
                // добавление новой заявки
                $text = filter_var($_POST['request_text'], FILTER_SANITIZE_STRING);
                $prepared = $connection->prepare("INSERT INTO request(user_id, request_name, request_theme, request_text, request_file_text, request_file_presentation) VALUES(:user_id, :request_name, :request_theme, :request_text, :request_file_text, :request_file_presenation)");
                $prepared->execute([$_SESSION['logged_user']['user_id'], $_POST['request_name'], $_POST['request_theme'], substr($text, 0, 500), $path . trim($_FILES['request_file_text']['name']), $path . trim($_FILES['request_file_presentation']['name'])]);
                // очищаем переменные сессии
                foreach ($_SESSION as $key => $value){
                    if($key != 'logged_user'){
                        unset($_SESSION[$key]);
                    }
                }
                $_SESSION['info_message'] = 'Заявка успешно создана!';
                header('Location: ../request?action=add');
            }
        }
    }
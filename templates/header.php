<?php
    session_start();
?>
<!doctype html>
<html lang="ru">
<!-- Начало head -->
<head>
    <title>Сайт конференции</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Подключение основных стилей сайта -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/request.css">
    <link rel="stylesheet" href="styles/request_add_page.css">
    <link rel="stylesheet" href="styles/request_item_page.css">
    <link rel="icon" type="image/svg+xml" href="icons/favicon.svg">
    <!-- Шрифт футера -->
    <link href='https://fonts.googleapis.com/css?family=BioRhyme' rel='stylesheet'>
</head>
<!-- Начало body -->
<body>
<!-- Контейнер верхнего фиксированного меню -->
<header class="header">
    <!-- Обертка основной части сайта -->
    <div class="container">
        <!-- Обертка содержимого верхнего фиксированного меню -->
        <div class="header_inner">
            <!-- Лого сайта -->
            <div class="logo">
                <a class="logo_link" href="index.php">Сайт конференции</a>
            </div>
            <!-- Меню навигации сайта -->
            <nav class="nav">
                <?php
                    // если есть залогиненный пользователь
                    if(isset($_SESSION['logged_user'])){
                        // определяем, находимся ли мы на странице 'request.php'
                        if(strcmp(str_replace($_SERVER['QUERY_STRING'], '', str_replace('?', '', $_SERVER['REQUEST_URI'])), '/request') == 0
                            && strcmp($_SERVER['QUERY_STRING'], 'action=add') != 0) {
                            // если да - выводим кнопку "Создать заявку"
                            echo "<a class=\"nav_link add_request_link\" href=\"request?action=add\"><div><span>Создать заявку</span></div></a>";
                        }
                        // если нет - выводим кнопку "Мои заявки"
                        else {
                            echo "<a class=\"nav_link request_link\" href=\"request\"><div><span>Мои заявки</span></div></a>";
                        }
                        echo "<a class=\"nav_link profile_link\" href=\"profile\"><div><span>Профиль</span></div></a>
                              <a class=\"nav_link logout_link\" href=\"actions/logout_action\"><div><span>Выход</span></div></a>";
                    }
                    else{
                        echo "<a class=\"nav_link main_link\" href=\"index\"><div><span>Главная</span></div></a>
                              <a class=\"nav_link login_link\" href=\"login\"><div><span>Вход</span></div></a>
                              <a class=\"nav_link registration_link\" href=\"register\"><div><span>Регистрация</span></div></a>";
                    }
                ?>
            </nav>
        </div>
    </div>
</header>
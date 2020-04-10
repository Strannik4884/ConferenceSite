<?php
    session_start();
    // блокируем доступ, если пользователь не авторизован
    if(!isset($_SESSION['logged_user'])){
        header('Location: login');
        die();
    }
    require_once("../lib/database.php");
    require("../templates/header.php")
?>
    <!-- Контейнер блока с основным содержимым -->
    <div id="content">
        <!-- Обертка основной части сайта -->
        <div class="container">
            <?php
                if(strcmp($_SESSION['logged_user']['account_role'], 'admin') == 0){
                    require ('../templates/request_list_page.php');
                }
                else if(isset($_GET['action'])){
                    // если вошёл админ - сразу открываем список всех заявок
                    if(strcmp($_GET['action'], 'add') == 0){
                        require ('../templates/request_add_page.php');
                    }
                }
                else if(isset($_GET['id'])){
                    require('../templates/request_item_page.php');
                }
                else {
                    require('../templates/request_list_page.php');
                }
            ?>
        </div>
    </div>
<?php
    require("../templates/footer.php")
?>
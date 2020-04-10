<?php
    session_start();
    // блокируем доступ, если пользователь не авторизован
    if(!isset($_SESSION['logged_user'])){
        header('Location: login');
    }
    else if(strcmp($_SESSION['logged_user']['account_role'], 'admin') == 0){
        header('Location: /');
    }
    require_once("../lib/database.php");
    require("../templates/header.php");
?>
    <!-- Контейнер блока с основным содержимым -->
    <div id="content">
        <!-- Обертка основной части сайта -->
        <div class="container">
            <?php
                if(isset($_GET['action'])){
                    if(strcmp($_GET['action'], 'change_name') == 0){
                        require ('../templates/change_name_page.php');
                    }
                    else if(strcmp($_GET['action'], 'change_password') == 0){
                        require ('../templates/change_password_page.php');
                    }
                    else if(strcmp($_GET['action'], 'change_work_study') == 0){
                        require ('../templates/change_work_study_page.php');
                    }
                    else if(strcmp($_GET['action'], 'change_position') == 0){
                        require ('../templates/change_position_page.php');
                    }
                    else if(strcmp($_GET['action'], 'change_achievements') == 0){
                        require ('../templates/change_achievements_page.php');
                    }
                    else{
                        require ('../templates/profile_page.php');
                    }
                }
                else{
                    require ('../templates/profile_page.php');
                }
            ?>
        </div>
    </div>
<?php
    require("../templates/footer.php")
?>
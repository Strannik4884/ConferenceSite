<div class="request_wrapper">
    <div class="request_list">
        <?php
        $page = 1;
        if(isset($_GET['page'])){
            if(ctype_digit($_GET['page'])){
                $page = $_GET['page'];
            }
        }
        if($page == 0){
            $page = 1;
        }
        // если вошёл админ - выводим все заявки
        if(strcmp($_SESSION['logged_user']['account_role'], 'admin') == 0){
            require ('request_admin_list_page.php');
        }
        else{
            require ('request_user_list_page.php');
        }
        ?>

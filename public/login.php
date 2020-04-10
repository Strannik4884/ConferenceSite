<?php
    session_start();
    // если пользователь уже вошёл - перенаправляем его обратно
    if(isset($_SESSION['logged_user'])){
        if(isset($_SERVER['HTTP_REFERER'])){
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else{
            header('Location: /');
        }
    }
    require("../templates/header.php")
?>
<!-- Контейнер блока с основным содержимым -->
<div id="content">
    <!-- Обертка основной части сайта -->
    <div class="container">
        <!-- Обертка содержимого блока входа -->
        <div class="login_wrapper">
            <div class="login_block">
                <div class="login-content">
                    <form action="actions/login_action.php" method="POST" id="login-form" class="form-login">
                        <span class="login-form-title">Авторизация</span>
                        <span class="login_text">Email</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="email" name="login" placeholder="Email" value="<?php
                            if(isset($_SESSION['login'])) {
                                echo $_SESSION['login'];
                                unset($_SESSION['login']);
                            }
                            ?>">
                            <span class="focus-input"></span>
                        </div>
                        <span class="login_text">Пароль</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="password" name="password" placeholder="Пароль">
                            <span class="focus-input"></span>
                        </div>
                        <div class="container-login-button">
                            <button class="login-button">Вход</button>
                        </div>
                        <?php
                            if(isset($_SESSION['error_message'])){
                                echo "<p class=\"message error_message\">".$_SESSION['error_message']."</p>";
                                unset($_SESSION['error_message']);
                            }
                            else if(isset($_SESSION['info_message'])){
                                echo "<p class=\"message info_message\">".$_SESSION['info_message']."</p>";
                                unset($_SESSION['info_message']);
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require("../templates/footer.php")
?>

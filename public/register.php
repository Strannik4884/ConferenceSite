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
        <div class="registration_wrapper">
            <div class="registration_block">
                <div class="registration-content">
                    <form action="actions/register_action.php" method="POST" id="registration-form" class="form-registration">
                        <span class="registration-form-title">Регистрация</span>
                        <span class="registration_text">ФИО</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="text" name="name" placeholder="ФИО" value="<?php
                                if(isset($_SESSION['name'])) {
                                    echo $_SESSION['name'];
                                    unset($_SESSION['name']);
                                }
                             ?>">
                            <span class="focus-input"></span>
                        </div>
                        <span class="registration_text">Email</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="email" name="login" placeholder="Email" value="<?php
                                if(isset($_SESSION['login'])) {
                                    echo $_SESSION['login'];
                                    unset($_SESSION['login']);
                                }
                            ?>">
                            <span class="focus-input"></span>
                        </div>
                        <span class="registration_text">Пароль</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="password" name="password" placeholder="Пароль">
                            <span class="focus-input"></span>
                        </div>
                        <span class="registration_text">Повторите пароль</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="password" name="password_confirm" placeholder="Повторите пароль">
                            <span class="focus-input"></span>
                        </div>
                        <span class="registration_text">Место учёбы/работы</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="text" name="work_study" placeholder="Место учёбы/работы" value="<?php
                                if(isset($_SESSION['work_study'])) {
                                    echo $_SESSION['work_study'];
                                    unset($_SESSION['work_study']);
                                }
                                ?>">
                            <span class="focus-input"></span>
                        </div>
                        <span class="registration_text">Должность</span>
                        <div class="wrap-input validate-input">
                            <input class="input" type="text" name="position" placeholder="Должность" value="<?php
                                if(isset($_SESSION['position'])) {
                                    echo $_SESSION['position'];
                                    unset($_SESSION['position']);
                                }
                            ?>">
                            <span class="focus-input"></span>
                        </div>
                        <span class="registration_text">Достижения</span>
                        <div class="wrap-input validate-input" data-validate = "Введите достижения">
                            <input class="input" type="text" name="achievements" placeholder="Достижения" value="<?php
                                if(isset($_SESSION['achievements'])) {
                                    echo $_SESSION['achievements'];
                                    unset($_SESSION['achievements']);
                                }
                            ?>">
                            <span class="focus-input"></span>
                        </div>
                        <div class="wrap-consent">
                            <input type="checkbox" name="is_consent" <?php
                                if(isset($_SESSION['is_consent'])){
                                    echo 'checked';
                                    unset($_SESSION['is_consent']);
                                }
                            ?>>
                            <label for="is_consent">Согласие на обработку данных</label>
                        </div>
                        <div class="container-registration-button">
                            <button class="registration-button">Зарегистрироваться</button>
                        </div>
                        <p class="message error_message">
                            <?php
                                echo $_SESSION['error_message'];
                                unset($_SESSION['error_message'])
                            ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require("../templates/footer.php")
?>

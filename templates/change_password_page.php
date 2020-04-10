<div class="profile_wrapper">
    <div class="change_block">
        <div class="change_content">
            <form action="actions/change_password_action.php" method="POST" id="change_form" class="form_change">
                <span class="change_form_title">Изменение пароля</span>
                <span class="change_form_text">Старый пароль</span>
                <div class="wrap-input validate-input">
                    <input class="input" type="password" name="old_password" placeholder="Старый пароль" value="<?php
                    if(isset($_SESSION['old_password'])){
                        echo $_SESSION['old_password'];
                        unset($_SESSION['old_password']);
                    }
                    ?>">
                    <span class="focus-input"></span>
                </div>
                <span class="change_form_text">Новый пароль</span>
                <div class="wrap-input validate-input">
                    <input class="input" type="password" name="new_password" placeholder="Новый пароль" value="<?php
                    if(isset($_SESSION['new_password'])){
                        echo $_SESSION['new_password'];
                        unset($_SESSION['new_password']);
                    }
                    ?>">
                    <span class="focus-input"></span>
                </div>
                <span class="change_form_text">Подтвердите новый пароль</span>
                <div class="wrap-input validate-input">
                    <input class="input" type="password" name="new_password_confirm" placeholder="Подтвердите новый пароль"><span class="focus-input"></span>
                </div>
                <div class="container_save_button">
                    <button class="save_button">Сохранить</button>
                </div>
                <p class="message error_message">
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
                </p>
            </form>
        </div>
    </div>
</div>
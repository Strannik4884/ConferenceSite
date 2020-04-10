<div class="profile_wrapper">
    <div class="change_block">
        <div class="change_content">
            <form action="actions/change_position_action.php" method="POST" id="change_form" class="form_change">
                <span class="change_form_title">Изменение должности</span>
                <span class="change_form_text">Должность</span>
                <div class="wrap-input validate-input">
                    <input class="input" type="text" name="position" placeholder="Должность" value="<?php
                    if(isset($_SESSION['position'])){
                        echo htmlentities($_SESSION['position'], ENT_QUOTES);
                        unset($_SESSION['position']);
                    }
                    else{
                        echo htmlentities($_SESSION['logged_user']['user_position'], ENT_QUOTES);
                    }
                    ?>">
                    <span class="focus-input"></span>
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
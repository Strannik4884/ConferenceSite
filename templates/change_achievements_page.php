<div class="profile_wrapper">
    <div class="change_block">
        <div class="change_content">
            <form action="actions/change_achievements_action.php" method="POST" id="change_form" class="form_change">
                <span class="change_form_title">Изменение достижений</span>
                <span class="change_form_text">Достижения</span>
                <div class="wrap-input validate-input">
                    <input class="input" type="text" name="achievements" placeholder="Достижения" value="<?php
                    if(isset($_SESSION['achievements'])){
                        echo htmlentities($_SESSION['achievements'], ENT_QUOTES);
                        unset($_SESSION['achievements']);
                    }
                    else{
                        echo htmlentities($_SESSION['logged_user']['user_achievements'], ENT_QUOTES);
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
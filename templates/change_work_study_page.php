<div class="profile_wrapper">
    <div class="change_block">
        <div class="change_content">
            <form action="actions/change_work_study_action.php" method="POST" id="change_form" class="form_change">
                <span class="change_form_title">Изменение места работы/учёбы</span>
                <span class="change_form_text">Место работы/учёбы</span>
                <div class="wrap-input validate-input">
                    <input class="input" type="text" name="work_study" placeholder="Место учёбы/работы" value="<?php
                    if(isset($_SESSION['work_study'])){
                        echo htmlentities($_SESSION['work_study'], ENT_QUOTES);
                        unset($_SESSION['work_study']);
                    }
                    else{
                        echo htmlentities($_SESSION['logged_user']['user_work_study'], ENT_QUOTES);
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
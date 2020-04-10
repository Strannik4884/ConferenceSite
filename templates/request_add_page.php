<?php
    require_once ('../lib/request_themes.php');
?>
<!-- Обёртка страницы добавления заявки -->
<div class="request_add_page_wrapper">
    <div class="request_add_page_block">
        <div class="request_add_page_content">
            <!-- Форма добавления заявки -->
            <form action="actions/request_add_action" method="POST" enctype="multipart/form-data" id="request_add_page_form_id" class="request_add_page_form">
                <span class="request_add_page_form_title">Создание заявки</span>
                <span class="request_add_page_text">Название доклада</span>
                <div class="wrap-input validate-input">
                    <input class="input" type="text" name="request_name" placeholder="Название доклада" value="<?php
                    // восстанавливаем значение из сессии если оно было введено ранее
                    if(isset($_SESSION['request_name'])) {
                        echo $_SESSION['request_name'];
                        unset($_SESSION['request_name']);
                    }
                    ?>">
                    <span class="focus-input"></span>
                </div>
                <span class="request_add_page_text">Тематика доклада</span>
                <div class="wrap-input validate-input">
                    <select class="input" name="request_theme">
                        <?php
                        // добавляем данные из конфигурационного файла
                        // в случае, если какое-то значение было выбрано до этого - восстанавливаем его из сессии
                        if(isset($_SESSION['request_theme'])) {
                            foreach ($request_themes as $value) {
                                if (strcmp($_SESSION['request_theme'], $value) == 0) {
                                    echo "<option selected>$value</option>";
                                } else {
                                    echo "<option>$value</option>";
                                }
                            }
                            unset($_SESSION['request_theme']);
                        }
                        else{
                            foreach ($request_themes as $value) {
                                echo "<option>$value</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <span class="request_add_page_text">Краткое описание доклада</span>
                <div class="area-wrap-input validate-input">
                            <textarea class="area-input" type="text" maxlength="500" name="request_text" placeholder="Краткое описание доклада"><?php
                                // восстанавливаем значение из сессии если оно было введено ранее
                                if(isset($_SESSION['request_text'])){
                                    echo $_SESSION['request_text'];
                                    unset($_SESSION['request_text']);
                                }
                                ?></textarea>
                    <span class="focus-input"></span>
                </div>
                <span class="request_add_page_text">Текст выступления</span>
                <div class="wrap-input validate-input">
                    <input id="req_file_text" class="input_file" type="file" name="request_file_text" placeholder="Текст выступления">
                    <label class="input_file_label" for="req_file_text">
                        <object type="image/svg+xml" data="icons/upload_file.svg"></object>
                        <span>Загрузить файл</span>
                    </label>
                    <span class="focus-input"></span>
                </div>
                <span class="request_add_page_text">Презентация</span>
                <div class="wrap-input validate-input">
                    <input id="req_file_presentation" class="input_file" type="file" name="request_file_presentation" placeholder="Презентация">
                    <label class="input_file_label" for="req_file_presentation">
                        <object type="image/svg+xml" data="icons/upload_file.svg"></object>
                        <span>Загрузить файл</span>
                    </label>
                    <span class="focus-input"></span>
                </div>
                <div class="request_add_page_button_container">
                    <button class="request_add_page_button">Создать заявку</button>
                </div>
                <?php
                // выводим сообщение об ошибки при его наличии
                if(isset($_SESSION['error_message'])){
                    echo "<p class=\"message error_message\">".$_SESSION['error_message']."</p>";
                    unset($_SESSION['error_message']);
                }
                // выводим информационное сообщение при его наличии
                else if(isset($_SESSION['info_message'])){
                    echo "<p class=\"message info_message\">".$_SESSION['info_message']."</p>";
                    unset($_SESSION['info_message']);
                }
                ?>
            </form>
        </div>
    </div>
</div>
<script>
    // скрипт отображения названия загруженного файла
    ;(function (document, window, index){
        'use strict';
        const inputs = document.querySelectorAll('.input_file');
        Array.prototype.forEach.call(inputs, function (input) {
            const label = input.nextElementSibling,
                labelVal = label.innerHTML;
            input.addEventListener('change', function (e) {
                let fileName = '';
                if (this.files && this.files.length === 1)
                    fileName = e.target.value.split('\\').pop();
                if (fileName)
                    label.querySelector('span').innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });
            input.addEventListener('focus', function () {
                input.classList.add('has-focus');
            });
            input.addEventListener('blur', function () {
                input.classList.remove('has-focus');
            });
        });
    }(document, window, 0));
</script>
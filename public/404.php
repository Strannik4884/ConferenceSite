<?php
    if(strcmp($_SERVER['REQUEST_URI'], '/404.php') != 0){
        header('Location: /404.php');
        die();
    }
    require("../templates/header.php");
?>
    <!-- Контейнер блока с основным содержимым -->
    <div id="content">
        <!-- Обертка основной части сайта -->
        <div class="container">
            <!-- Обертка содержимого блока "О сайте" -->
            <div class="http_message_block">
                <div id="http_message_text">
                    <span>Ресурс не найден</span>
                </div>
            </div>
        </div>
    </div>
<?php
    require("../templates/footer.php")
?>
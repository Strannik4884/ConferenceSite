<?php
    require_once("../lib/database.php");
    require("../templates/header.php")
?>
<!-- Контейнер блока с основным содержимым -->
<div id="content">
    <!-- Обертка основной части сайта -->
    <div class="container">
        <!-- Обертка содержимого блока "О сайте" -->
        <div class="about_block">
            <div id="about_text">
                <span><a class="about_link" href="http://www.conference-site.local:8080">Conference Site</a> предназначена для регистрации участников и подачи заявок на конференции по доступным тематикам.</span>
            </div>
        </div>
    </div>
</div>
<?php
    require("../templates/footer.php")
?>
<!-- Обёртка страницы отображения полной заявки -->
<div class="request_wrapper">
    <div class="request_item_wrapper">
        <?php
            $id = 0;
            if(ctype_digit($_GET['id'])){
                $id = $_GET['id'];
            }
            $prepared = $connection->prepare("select * from request where user_id = :user_id and request_id = :request_id");
            $prepared->execute([$_SESSION['logged_user']['user_id'], $id]);
            $item = $prepared->fetch();
        ?>
        <div class="request_item">
            <div class="request_item_title"><a class="request_item_link" href="request?id=<?=$item['request_id']?>"><?=htmlentities($item['request_name'], ENT_QUOTES)?></a></div>
            <div class="request_item_text">
                <span>Тематика доклада:</span>
                <span><?= $item['request_theme'] ?></span>
            </div>
            <div class="request_item_text">
                <span>ФИО:</span>
                <span><?=$_SESSION['logged_user']['user_name']?></span>
            </div>
            <div class="request_item_text">
                <span>Email:</span>
                <a class="request_item_link" href="mailto:<?=$_SESSION['logged_user']['account_login']?>"><span><?=$_SESSION['logged_user']['account_login']?></span></a>
            </div>
            <div class="request_item_text">Краткое описание доклада:</div>
            <div class="request_item_text">
                <textarea readonly class="request_item_textarea"><?=htmlentities($item['request_text'], ENT_QUOTES)?></textarea>
            </div>
            <div class="request_item_text">
                <a class="request_item_link" href="actions/get_file?file=<?=str_replace('uploads/', '', $item['request_file_text'])?>">Текст выступления</a>
                <a class="request_item_link" href="actions/get_file?file=<?=str_replace('uploads/', '', $item['request_file_presentation'])?>">Презентация</a>
            </div>
            <div class="request_item_buttons">
                <a class="request_item_link" href="request?page=<?php
                // определяем, на какой странице должна находиться открытая заявка
                $prepared = $connection->prepare("select request_id from request where user_id = :user_id order by request_id desc ");
                $prepared->execute([$_SESSION['logged_user']['user_id']]);
                $page = 1;
                $count = 1;
                foreach ($prepared as $value) {
                    if ($item['request_id'] == $value['request_id']) {
                        break;
                    }
                    if ($count == 5) {
                        $page++;
                        $count = 0;
                    }
                    $count++;
                }
                echo $page;
                ?>">Вернуться к списку заявок</a>
            </div>
        </div>
    </div>
</div>
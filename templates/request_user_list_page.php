<?php
    $page = 1;
    if(isset($_GET['page'])){
        if(ctype_digit($_GET['page'])){
            $page = $_GET['page'];
        }
    }
    if($page == 0){
        $page = 1;
    }
    $prepared = $connection->prepare("select * from request where user_id = :user_id order by request_id desc limit 5 offset :offset");
    $prepared->execute([$_SESSION['logged_user']['user_id'], ($page - 1) * 5]);
    $count = $prepared->rowCount();
    $pages_count = ceil($count / 5);
    foreach ($prepared as $item) {
        $sub_text = htmlentities($item['request_text'], ENT_QUOTES);
        if(strlen($item['request_text']) > 150){
            $sub_text = substr($item['request_text'], 0, 150) . "...";
        }
    echo "<div class=\"request_list_item\">
                              <div class=\"request_list_item_title\"><a class=\"request_list_item_link\" href=\"request?id=" . $item['request_id'] . "\">" . htmlentities($item['request_name'], ENT_QUOTES) ."</a></div>
                              <div class=\"request_list_item_text\">
                                    <span>Тематика доклада:</span>
                                    <span>" . $item['request_theme'] . "</span>
                                </div>
                                <div class=\"request_list_item_text\">
                                    <span>ФИО:</span>
                                    <span>" . $_SESSION['logged_user']['user_name'] . "</span>
                                </div>
                                <div class=\"request_list_item_text\">
                                    <span>Email:</span>
                                    <a class=\"request_list_item_link\" href=\"mailto:" . $_SESSION['logged_user']['account_login'] . "\"><span>" . $_SESSION['logged_user']['account_login'] . "</span></a>
                                </div>
                                <div class=\"request_list_item_text\">Краткое описание доклада:</div>
                                <div class=\"request_list_item_text\"><textarea readonly class=\"request_list_item_textarea\">" . $sub_text . "</textarea></div>
                            </div>";
        }
        ?>
    </div>
    <div class="request_list_splash"></div>
    <div class="request_page_numeration">
        <?php
        if(strcmp($_SESSION['logged_user']['account_role'], 'admin') == 0){
            $prepared = $connection->prepare("select * from request");
            $prepared->execute();
        }
        else{
            $prepared = $connection->prepare("select * from request where user_id = :user_id");
            $prepared->execute([$_SESSION['logged_user']['user_id']]);
        }
        $pages_count = ceil($prepared->rowCount() / 5);
        if($pages_count == 1) {
            $pages_count = 0;
        }
        for($i = 1; $i <= $pages_count; ++$i) {
            if ($i == $page) {
                echo "<a style=\"color: #a2a8d0\" class=\"request_page_link\" href=\"request?page=" . $i . "\">" . $i . "</a>";
            } else {
                echo "<a class=\"request_page_link\" href=\"request?page=" . $i . "\">" . $i . "</a>";
            }
        }
    ?>
    </div>
</div>

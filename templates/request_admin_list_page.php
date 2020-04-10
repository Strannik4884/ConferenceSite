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
        $prepared = $connection->prepare("select request_id, account_login, user_name, request_name, request_theme, request_text from request R inner join \"user\" U on R.user_id = U.user_id order by request_id desc limit 5 offset :offset");
        $prepared->execute([($page - 1) * 5]);
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
                                    <span>" . $item['user_name'] . "</span>
                                </div>
                                <div class=\"request_list_item_text\">
                                    <span>Email:</span>
                                    <a class=\"request_list_item_link\" href=\"mailto:" . $item['account_login'] . "\"><span>" . $item['account_login'] . "</span></a>
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
            $prepared = $connection->prepare("select * from request");
            $prepared->execute();
            $pages_count = ceil($prepared->rowCount() / 5);
            if($pages_count == 1) {
                $pages_count = 0;
            }
            for($i = 1; $i <= $pages_count; ++$i){
                if($i == $page) {
                    echo "<a style=\"color: #a2a8d0\" class=\"request_page_link\" href=\"request?page=" . $i . "\">" . $i . "</a>";
                }
                else{
                    echo "<a class=\"request_page_link\" href=\"request?page=" . $i . "\">" . $i . "</a>";
                }
            }
        ?>
    </div>
</div>
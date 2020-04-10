<!-- Обёртка страницы отображения профиля пользователя -->
<div class="profile_wrapper">
    <div class="profile_content_wrapper">
        <div class="profile_content">
            <div class="profile_title"><span>Профиль пользователя</span></div>
            <div class="profile_text">
                <span>ФИО пользователя:</span>
                <span><?=$_SESSION['logged_user']['user_name']?></span>
                <span><a class="profile_edit_link" href="/profile?action=change_name">Изменить</a></span>
            </div>
            <div class="profile_text">
                <span>Email пользователя:</span>
                <span><a class="profile_login_link" href="mailto:<?=$_SESSION['logged_user']['account_login']?>"><?=$_SESSION['logged_user']['account_login']?></a></span>
            </div>
            <div class="profile_text">
                <span>Пароль пользователя:</span>
                <input type="password" value="1234567890" readonly>
                <span><a class="profile_edit_link" href="/profile?action=change_password">Изменить</a></span>
            </div>
            <div class="profile_text">
                <span>Место учёбы/работы:</span>
                <span><?=htmlentities($_SESSION['logged_user']['user_work_study'], ENT_QUOTES)?></span
                <span><a class="profile_edit_link" href="/profile?action=change_work_study">Изменить</a></span>
            </div>
            <div class="profile_text">
                <span>Должность:</span>
                <span><?=htmlentities($_SESSION['logged_user']['user_position'], ENT_QUOTES)?></span
                <span><a class="profile_edit_link" href="/profile?action=change_position">Изменить</a></span>
            </div>
            <div class="profile_text">
                <span>Достижения:</span>
                <span><?=htmlentities($_SESSION['logged_user']['user_achievements'], ENT_QUOTES)?></span
                <span><a class="profile_edit_link" href="/profile?action=change_achievements">Изменить</a></span>
            </div>
        </div>
    </div>
</div>
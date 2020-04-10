# ConferenceSite
Сайт конференции для лабораторной работы №2 по дисциплине "Технологии разработки WEB-приложений"

Структура проекта:

├───config - папка с конфигурационными файлами сайта

│----------file_types.ini - разрешенные типы файлов для текста выступлений и презентаций

│----------request_themes.list - список доступных тем конференции

│----------server.ini.dist - пример главного конфигурационного файла: заполните данные и переименуйте в server.ini

│----------site.dump - дамп базы данных. Содержит полную структура БД и пользователя с правами администратора

│

├───lib - папка с библиотечными скриптами

│

├───public - основная публичная часть сайта

│   │


│   ├───actions - обработчики событий

│   │

│   ├───icons - иконки сайта

│   │

│   ├───images - картинки сайта

│   
│   ├───styles - стили сайт

│   │

│   └───uploads - папка с пользовательскими файлами. Содержит файл .htaccess для запрета прямого доступа к файлам в папке

│

└───templates - шаблоны страниц и элементов сайта

Для разворачивания сайта в OpenServer:

- переведите настройку доменов в ручное управление

- укажите имя домена и путь до папки public

- создайте базу данных и разверните дамп и папки config

- настройте конфигурационные файлы сайта

- убедитесь, что сервер apache2 поддерживает выполнение .htaccess - файлов

Для тестов был открыт сайт [ConferenceSite](http://www.conference-site.ru).

Данные для входа:

Первый пользователь:

логин: test0@test.ru

пароль: Test0!

Второй пользователь:

логин: test1@test.ru

пароль: Test1!

Администратор:

логин: odmin@admin.ru

пароль: odmin

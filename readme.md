---
***Контрольная работа по основам CSS и PHP***
---
*Что бы использовать проект, на рабочей машине должно быть установлено следующее ПО*
+ PHP 7.2
+ Composer
+ MySQL
---
1. Для того что бы скачать проект выполните команду, находясь в папке в которую хотите скачать проект
    + git clone https://github.com/Dysha96/roboBlog.git
2. Выполните установку пакетов
    + composer install
3. php vendor/robmorgan/phinx/bin/phinx init инициализация настроек для миграции и сидирования
4. Заполните данные подключения к бд
    + для выполнения миграций в файле phinx.yml
    + для работы приложения в файле public/.env по подобию public/setting.env
5. для точго что бы выполнить миграции и сидирование выполните команды по порядку
    + php vendor/robmorgan/phinx/bin/phinx migrate
    + php vendor/robmorgan/phinx/bin/phinx seed:run -s UsersSeeder
    + php vendor/robmorgan/phinx/bin/phinx seed:run -s ArticlesSeeder
6. что бы запустить проект перейдите в папку /public и выполните
    + php -S localhost:8080 после чего проект будет доступен по даному адресу
---
Для тестирования доступны следующие пользователи 
+ admin1 password Роль admin
+ admin2 password Роль admin
+ user1 qwerty Роль user
+ user2 qwerty Роли нет
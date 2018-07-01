---

***Контрольная работа по основам CSS и PHP***

---

*Что бы использовать проект на рабочей машние должно быть установлено следующее ПО*

+ PHP 7.2
+ Composer
+ MySQL

---
1. Для того что бы скачать проект выполните команду находясь в папку в которую хотите скачать проект
    + git clone https://github.com/Dysha96/roboBlog.git
3. Выполните установку пакетов
    + composer install
3. для точго что бы выполнить миграции и сидирование выполните команды по порядку
    + php vendor/robmorgan/phinx/bin/phinx init инициализация настроек
    + php vendor/robmorgan/phinx/bin/phinx migrate
    + php vendor/robmorgan/phinx/bin/phinx seed:run -s UsersSeeder
    + php vendor/robmorgan/phinx/bin/phinx seed:run -s ArticlesSeeder
4. что бы запустить проект перейдите в папку /public и выполните
    + php -S localhost:8080 после чего проект будет доступен по даному адрессу
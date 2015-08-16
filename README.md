## Игра быки и коровы (4 цифры)

Подробнее об игре https://ru.wikipedia.org/wiki/Быки_и_коровы

### Установка

Скачайте. Распакуйте. Сделайте `composer install` в корне каталога.

Создайте БД и пользователя:

```
mysql -uroot -e "
CREATE DATABASE dg;
GRANT ALL PRIVILEGES ON dg.* TO dg@'%' IDENTIFIED BY '123';
FLUSH PRIVILEGES;"
```

Скопируйте файл `conf/example.config.php` в `conf/config.php` и поправьте параметры подключения к БД.

### Как играть

Запустите сервер

`php -S localhost:8000`

Зайдите в browser `localhost:8000/?tel=921931941`

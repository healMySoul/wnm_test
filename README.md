# WN Media Group тестовое задание

Мануал:

1. Клонируем проект: git clone https://github.com/healMySoul/wnm_test.git

2. 
    - Убеждаемся, что на портах 8080, 8081, 8082 ничего не висит
    - Поднимаем контейнеры: в корне проекта выполняем docker-compose up

<br>

3. 
    - Заходим в php-контейнер: docker-compose exec php /bin/bash
    - Создаем файл с переменными окружения: cp .env.example .env
    - Устанавливаем зависимости: composer install
    - Генерируем ключ приложения: php artisan key:generate
    - Генерируем ключ JWT: php artisan jwt:secret
    - Выполняем миграции: php artisan migrate

<br>

4) 
    - Открываем файл с примерами запросов к API: /api.http
    - Выполнять можно с помощью встроенного плагина PHPStorm, либо в Postman
    - Пункт 11: регистрируем юзера
    - Пункт 12: аутентифицируемся и получаем токен
    - Подставляем этот токен в плейсхолдер {token} для запросов к API, которые требуют аутентификации
    - Перед созданием книги нужно создать хотя бы 1 автора

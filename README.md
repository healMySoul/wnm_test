# WN Media Group тестовое задание

Мануал:

1. Клонируем проект: git clone https://github.com/healMySoul/wnm_test.git

2. Убеждаемся, что на портах 8080, 8081, 8082 ничего не висит
  1. Поднимаем контейнеры: docker-compose up

3. Заходим в php-контейнер: docker-compose exec php /bin/bash
3.1) Создаем файл с переменными окружения: cp .env.example .env
3.2) Устанавливаем зависимости: composer install
3.3) Генерируем ключ приложения: php artisan key:generate
3.4) Генерируем ключ JWT: php artisan jwt:secret
3.5) Выполняем миграции: php artisan migrate

4) Открываем файл с примерами запросов к API: /api.http
Выполнять можно с помощью встроенного плагина PHPStorm, либо в Postman
4.1) Пункт 11: регистрируем юзера
4.2) Пункт 12: авторизуемся и получаем токен
4.3) Подставляем этот токен в плейсхолдер {token} для запросов к API, которые требуют аутентификации
4.4) Перед созданием книги нужно создать хотя бы 1 автора

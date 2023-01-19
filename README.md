# Тестовое задание
Доброго дня.
Данный репозиторий представляет из себя тестовое задание для выполнения перед собеседованием на вакансию [Web-разработчик](https://hh.ru/vacancy/75866060).

## Установка
Установите все зависимости с помощью composer

    composer install

Скопируйте .env.example и внесите необходимые изменения конфигурации в файл .env

    cp .env.example .env

Запустите миграцию базы данных (**Установите подключение к базе данных в .env перед миграцией**)

    php artisan migrate

Загрузка начальных данных в БД

    php artisan db:seed

Создать ссылку на storage
    
    php artisan storage:link

Запустите локальный сервер разработки

    php artisan serve

Теперь вы можете получить доступ к серверу по адресу http://localhost:8000.

PS:
Для работы Яндекс.Карт необходимо сгенерировать API-ключ.

Получить ключ можно в Кабинете разработчика: https://developer.tech.yandex.ru/keys/

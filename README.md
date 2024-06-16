# Сервис рекламы

## Основной стэк
- PHP 8.1
- Laravel 9
- MySQL 8

### Используемые инструменты
- [Filament](https://filamentphp.com/docs/3.x/panels/installation)
- [Spatie: laravel-query-builder](https://github.com/spatie/laravel-query-builder)
- [Spatie: laravel-route-attributes](https://github.com/spatie/laravel-route-attributes)
- [Laravel Pint](https://github.com/laravel/pint)
- [Pest](https://pestphp.com)
- [Larastan](https://github.com/nunomaduro/larastan)
- [Saloon](https://github.com/Sammyjo20/Saloon)
- [Laravel Envoy](https://github.com/laravel/envoy)

## Установка

1. Клонируем репозиторий
    ```
    git clone git@gl.erkapharm.ru:ultrashop/comment.git
    ```
2. Устанавливаем зависимости
    ```
    composer install
    ```
3. Настраиваем файл .env
    ```
    cp .env.example .env
    php artisan key:gen
    // заполняем параметры APP_*, DB_*, ...
    // по необходимости, заполняем доступы к БД со старыми акциями для переноса
    ```
4. Запуск через [Laravel Sail](https://laravel.com/docs/9.x/sail) (опционально)
    ```
    ./vendor/bin/sail up -d
    ```
5. Запускаем миграции
    ```
    php artisan migrate
    или
    sail artisan migrate
    ```
6. Запускаем импорт статей
    ```
    php artisan app:import-articles
    или 
    sail artisan app:import-articles
    ```
7. Доступы в админку
    - http://localhost/admin
    - email: `admin@test.com`
    - pass: `qwerty`

## Документация API
[Confluence: Сервис акций (comments)](https://kb.erkapharm.com/confluence/pages/viewpage.action?pageId=129670952)

## Линтеры

### Laravel Pint
- `composer lint` - проверка код-стайла
- `composer lint-fix` - проверка код-стайла с автоисправлением
- Правила настраиваются в файле `pint.json`

### Larastan
- `composer larastan` - статический анализ кода
- Правила настраиваются в файле `phpstan.neon`

## Тесты

### Pest
- `php artisan test` - запуск тестов

## Деплой

Настроен деплой с помощью Laravel Envoy

Для деплоя на dev локально запускаем команду:
```
    ./vendor/bin/envoy run deployToDev
```

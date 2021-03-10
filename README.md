<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
    </a>
</p>

### Тестовое задание. Сделать api на laravel

1. Скачать проект 

2. Открыть через консоль
    ```php
    cd tzrsdigital.loc-api
    ```

3. Произвести миграцию
    ```php
    php artisan migrate
    ```

4. Создание ключей passport
    ```php
    php artisan passport:install
    ```

#### Регистрация:
Ссылка: [http://localhost:8000/api/register](http://localhost:8000/api/register)

POST - запрос. Принимаемые параметры:
```php
last_name=Иван
first_name=Петров
patronymic=Яковлев
email=test@mail.ru
phone=+79999999999
password=Tests1000#
password_confirm=Tests1000#
```
- Успешно - 200
```json
{
    "success": true,
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiY2IyOTIyZDBmYTFjODc4MGUwMWVlYTA0ZTU2YjZlYjg2ZThhZGQ3YjA2ODUwMWZlMGRhZWQ4YjA0N2I4NmQ3N2UwNTY5YjM4MzFiNTFkNjQiLCJpYXQiOiIxNjE1MzkwOTI0Ljk1NzU0NiIsIm5iZiI6IjE2MTUzOTA5MjQuOTU3NTQ4IiwiZXhwIjoiMTY0NjkyNjkyNC45NTMxNzUiLCJzdWIiOiIxMCIsInNjb3BlcyI6W119.nv1khECM5lRawYwnRcMXgNk59v6mOWTbpcQgxbYO1SOzUKoAbgFdV2BbTND74oQZCsRfyU6_9BNKDr0BVRiFqiuESNWELSGZDGb0M4ZJmpiAf2tqdtHteDqFmkHTRj2DrHxzLl1fRZ8ZHdxgegmWB4O4C9eKSPOxBfpgoaM8YH1HGrQHPQdhY2ojODdPK5HCbYCvi2bAcknNJDj4xxQRzk8v_laEVREPi3AR2itp90EfeiJHodmigryePjP4kykDuZNYHuDxKc_EGYhvuNBEXB_G99ASrRHiUM7CW_422Ji8665CgAeKlpZSwViCNOQGfj-3aoYvZpGSC6yOvBwTDeKSkqkZolHkuSqy5RHDEEkClNJezUAee6AsvDFPcXdigEM4Xtrmu-BupAJt32WUXkSIfBNWW2bvXnC2buldTWjuMN0qNvaFnHWcBo4VNQa1J36Ffpeiv5fL3SvKdbJxUpXupzv8oC5KyxSMFEFtk6vt9TFHIBkDWtmMN_c7iOoF7OudHBbRHS7UebqHKD333Mo0tSYvgBWQRKuWbOoxnEX487qjxMxfgMS172_A8PIGmPKz-DdVbOcEloTgzCOgzuVfPneSf5UNH6_uq_2GE0XPbDWMjFxN2_BDT6qKEk1I6NsQkdfghxdyHZRVW_18zQCNVdcMzPfol9eEkKEdK9U",
        "name": null
    },
    "message": "User register successfully."
}
```
- Ошибка - 404 
```json
{
    "success": false,
    "message": "Validation Error.",
    "data": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```

#### Авторизация:
Ссылка: [http://localhost:8000/api/login](http://localhost:8000/api/login)

POST - запрос. Принимаемые параметры:
```php
email=test@mail.ru
password=Tests1000#
```
или
```php
phone=+79999999999
password=Tests1000#
```

- Ответ - 200
```json
{
    "success": true,
    "data": {
        "id": 10,
        "last_name": "tests",
        "first_name": "tests",
        "patronymic": "tests",
        "email": "dx2ss22x@gmail.com",
        "phone": "+79913279299",
        "created_at": "2021-03-10T15:42:04.000000Z",
        "updated_at": "2021-03-10T15:42:04.000000Z"
    },
    "message": "Авторизация удалась"
}
```

- Ошибка - 404
```json
{
    "success": false,
    "message": "Авторизация не удалась"
}
```

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
    </a>
</p>

## Тестовое задание. Сделать api на laravel

### Установка/Запуск
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
5. Фейковые данные:

    Каталоги:
    ```php
    php artisan db:seed CatalogTableSeeder
    ```
   
   Свойства:
   ```php
    php artisan db:seed PropertyTableSeeder
    ```
   
   Продукты:
   ```php
    php artisan db:seed ProductTableSeeder
    ```
   
   Сгенерировать свойства продуктов
   ```php
    php artisan db:seed PropertiesListSeeder
    ```

### Список запросов
Ссылка: [http://localhost:8000/api/](http://localhost:8000/api/)

|№|Ссыка|Название|Запрос|
|:---|:---|:---|:---:|
|1|[/register](#регистрация---параметры)|Регистрация|POST|
|2|[/login](#авторизация---параметры)|Авторизация|POST|
|3|/products|Получить все продукты|GET|
|4|/products|Добавить новый продукт|POST|
|5|/products/{idProduct}|Получить информацию о продукте|GET|
|6|/products/{idProduct}|Обновить информацию продука|PUTH/UPDATE|
|7|/products/{idProduct}|Удалить продукт|POST|
|8|/catalogs|Получить все каталоги|GET|
|9|/catalogs|Добавить новый каталог|POST|
|10|[/catalogs/{idCatalog}](#каталог---параметры)|Получить информацию о каталоге|GET|
|11|[/catalogs/{idCatalog}](#каталог---параметры)|Обновить информацию каталога|PUTH/UPDATE|
|12|[/catalogs/{idCatalog}](#каталог---параметры)|Удалить каталог|POST|

Начиная с 3го пункта требуется передавать Header:
```php
Authorization: Bearer KEY
Accept: application/json
```

Пример запроса:
http://localhost:8000/api/login

#### Регистрация - параметры:
|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|last_name|+|Иванов|Имя|
|first_name|+|Иван|Фамилия|
|patronymic|+|Иванович|Отчество|
|email|+|test@gmail.com|Почта|
|phone|+|+79999999999|Телефон|
|password|+|Tests1000#|Пароль|
|password_confirm|+|Tests1000#|Подтвердить пароль|

#### Авторизация - параметры:
|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|login|+|email/phone|Логин|
|password|+|Tests1000#|Пароль|


#### Каталог - параметры:
|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|title|+|Диван|Название|

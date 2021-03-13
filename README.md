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
    php artisan db:seed PropertyTableSeeder
    ```

### Список запросов
Ссылка: [http://localhost:8000/api/](http://localhost:8000/api/)

|№|Ссыка|Название|Запрос|
|:---|:---|:---|:---:|
|1|[/register](#регистрация)|Регистрация|POST|
|2|[/login](#авторизация)|Авторизация|POST|
|3|/catalogs|Получить все каталоги|GET|
|4|/catalogs/{idCatalog}|Получить информацию о каталоге|GET|
|5|[/catalogs](#каталог)|Добавить новый каталог|POST|
|6|[/catalogs/{idCatalog}](#каталог)|Обновить информацию каталога|PUT/PATCH|
|7|/products|Получить все продукты|GET|
|8|/products/{idProduct}|Получить информацию о продукте|GET|
|9|[/products](#продукты)|Добавить новый продукт|POST|
|10|[/products/{idProduct}](#продукты)|Обновить информацию продука|PUT/PATCH|
|11|[/products/filter](#фильтр)|Фильтрация продуктов|POST|
|12|/properties|Получить все свойства|GET|
|13|/properties/{idProperty}|Получить информацию о свойстве|GET|
|14|[/properties](#свойства)|Добавить новое свойство|POST|
|15|[/properties/{idProperty}](#свойства)|Обновить информацию свойства|PUT/PATCH|


Начиная с 3го пункта требуется передавать Header:
```php
Authorization: Bearer KEY
Accept: application/json
```

#### Регистрация:
Параметры:

|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|last_name|+|Иванов|Имя|
|first_name|+|Иван|Фамилия|
|patronymic|+|Иванович|Отчество|
|email|+|test@gmail.com|Почта|
|phone|+|+79999999999|Телефон|
|password|+|Tests1000#|Пароль|
|password_confirm|+|Tests1000#|Подтвердить пароль|

#### Авторизация:
Пример запроса:
```php
http://localhost:8000/api/login
```

Параметры:

|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|login|+|email/phone|Логин|
|password|+|Tests1000#|Пароль|

#### Каталог:
Пример запроса:
```php
http://localhost:8000/api/catalogs
```

Параметры:

|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|title|+|Диван|Название|

#### Продукты:
Пример запроса:
```php
http://localhost:8000/products
```

Параметры:

|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|name|+|Диван|Название|
|description|+|Мягкий диван|Описание|
|price|+|15000|Цена|
|count|+|100|Количество|
|catalog_id|+|ID - ГЕНЕРИРУЕТСЯ|Каталог где находится товар|
|properties|+|ГЕНЕРИРУЕТСЯ|Свойства товара|

##### Фильтр:
Пример запроса:
```php
http://localhost:8000/api/products/filter?properties[Размер][]=quia blanditiis&properties[Тип][]=dolor odio&priceFrom=6000&priceTo=100000&count=400&q=
```

Параметры:

|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|properties[PROPERTY_NAME][]|+|PROPERTY_VALUE|Параметры фильтрации|
|priceFrom|+|0|Цена От|
|priceTo|+|100000|Цена До|
|q|+|VALUE|Поиск по названию|

#### Свойства:
Пример запроса:
```php
http://localhost:8000/api/properties
```

Параметры:

|Параметр|Важно|Значение|Данные|
|:---|:---|:---|:---|
|title|+|Размер|Название свойства|
|value|+|20x40|Значение свойства|

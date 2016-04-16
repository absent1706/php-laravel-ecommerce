# Laravel eCommerce site blueprint

## Installation

### Step 1
```shell
composer install
```
### Step 2
Set DB credentials in config/database.php and create DB (DB name in set in config/database.php)

### Step 3
Integrate EAV package with Laravel

Include the `EavquentServiceProvider` to the providers array in `config/app.php`. It will bootstrap the package for us:

```php
'providers' => [
    ...
    Devio\Eavquent\EavquentServiceProvider::class
    ...
]
```

Once the Service Provider is loaded, we just have to publish the package assets:
```shell
php artisan vendor:publish --provider="Devio\Eavquent\EavquentServiceProvider"
```
### Step 4
```shell
php artisan migrate
php artisan db:seed
```
If you have problems with migrations, create DB from dump.sql (file in project folder).

If you want comletely refresh DB, type
```shell
mysqladmin -uroot drop laravel-ecommerce && mysqladmin -uroot create laravel-ecommerce && php artisan migrate && php artisan db:seed
```

### Step 5
```shell
php artisan serve
```

Now you should see site at http://localhost:8000




## About Mari

Mari is a Laravel CMS package that aims to streamline Web Development process.


## Dependencies
1) [Entrust](https://github.com/Zizaco/entrust)
2) [Laravel Datatables](https://github.com/yajra/laravel-datatables)
3) [Intervention](https://github.com/Intervention/image)
4) [Revisionable](https://github.com/VentureCraft/revisionable)


## Installation

1) In order to install Mari, just add the following to your composer.json. Then run `composer update`:

```json
"featherwebs/mari": "@dev"
```

2) Open your `config/app.php` and add the following to the `providers` array:

```php
Featherwebs\Mari\FeatherwebsServiceProvider::class,
```

3) Run the command below to publish the package templates:

```shell
php artisan vendor:publish --force
```
and select `Featherwebs\Mari\FeatherwebsServiceProvider`

4) Open your `app/User.php` change it to:

```php
use Featherwebs\Mari\Models\FeatherwebsUser;

class User extends FeatherwebsUser
{
...
}
```
5) Run migrations
```php
php artisan migrate --path="vendor/featherwebs/mari/src/database/migrations"
```

6) Run seeds
```php
php artisan db:seed --class="Featherwebs\Mari\Seeder\MariSeeder"
```

7)  You also need to add the following:

```php
    'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
    'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
    'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
```

to `routeMiddleware` array in `app/Http/Kernel.php`.

8)  You also need to add the following:

```php
    'uploads' => [
        'driver' => 'local',
        'root' => storage_path('app/public/files/uploads'),
        'url' => env('APP_URL').'/storage/files/uploads',
        'visibility' => 'public',
    ],
```

to `disks` array in `config/filesystems.php`.
9)  You also need to add the following:

```php

    ImageWasUploaded::class => [
        \Featherwebs\Mari\Listeners\ImageUploaded::class,
    ],
    ImageIsRenaming::class => [
        \Featherwebs\Mari\Listeners\ImageRenamed::class
    ],
    ImageWasDeleted::class => [
        \Featherwebs\Mari\Listeners\ImageDeleted::class
    ],
```

to `listen` array in `App/Listeners/EventServiceProvider`.



## Contributing

Thank you for considering contributing to the Featherwebs Mari framework!


## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to Srawan Shrestha at srawan@featherwebs.com. All security vulnerabilities will be promptly addressed.


## License

The Featherwebs Mari is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

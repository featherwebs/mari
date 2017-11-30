## About Mari

Mari is a Laravel CMS package that aims to streamline Web Development process.

## Installation

1) In order to install Mari, just run `composer require featherwebs/mari`

2) Open your `config/app.php` and add the following to the `providers` array:

```php
Featherwebs\Mari\FeatherwebsServiceProvider::class,
```

3) Publish the Laravel default auth scaffolds.

```shell
php artisan make:auth
```

4) Run the command below to publish the package templates:

```shell
php artisan vendor:publish
```

5) Open your `app/User.php` change it to:

```php
use Featherwebs\Mari\Models\FeatherwebsUser;

class User extends FeatherwebsUser
{
...
}
```
6) Update your `migrations/DatabaseSeeder.php` and add the following:
```php
public function run()
{
    ...
    $this->call(RolesTableSeeder::class);
    $this->call(UsersTableSeeder::class);
    $this->call(PagesTableSeeder::class);
    $this->call(SettingsTableSeeder::class);
    ...
}
```

7) Run the seeds:
```shell
php artisan db:seed
```

8)  If you want to use Entrust [Middleware](#middleware) (requires Laravel 5.1 or later) you also need to add the following:

```php
    'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
    'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
    'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
```

to `routeMiddleware` array in `app/Http/Kernel.php`.


## Contributing

Thank you for considering contributing to the Featherwebs Mari framework!

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Srawan Shrestha at srawan@featherwebs.com. All security vulnerabilities will be promptly addressed.

## License

The Featherwebs Mari is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Filemanager tool

![Filemanager tool](https://raw.githubusercontent.com/KarimQaderi/Zoroaster-Filemanager/master/1.png)

## نصب 

```bash
composer require karim-qaderi/zoroaster-filemanager

php artisan vendor:publish --tag=Zoroaster-filemanager-assets
```


### Field

```php
use KarimQaderi\ZoroasterFilemanager\FilemanagerField;

FilemanagerField::make('عکس','img');

```


## سطح دسترسی 

برای اینکه سطح دسترسی رو بزارید فایل `app/Providers/ZoroasterServiceProvider.php` رو باز کنید کد زیر رو در `boot` قرار دهید. 

```php
/**
 * Bootstrap any application services.
 *
 * @return void
 */
protected function boot()
{
    Gate::define('ZoroasterFilemanager', function ($user) {
        return in_array($user->email, [
            'karimqaderi1@gmail.com',
        ]);
    });
}
```
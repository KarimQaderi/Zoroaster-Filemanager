## Filemanager tool for Laravel Nova


## نصب 

فایل composer.json باز کنید و کد زیر رو قرار دهید :

```json
    "require": {
        "karim-qaderi/zoroaster-filemanager": "*"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/KarimQaderi/Zoroaster-Filemanager.git"
        }
    ],
```

```bash
composer update
```


### Field

```php
use KarimQaderi\ZoroasterFilemanager\FilemanagerField;

FilemanagerField::make('عکس','img');

```


## سطع دسترسی 

برای اینکه سطع دسترسی رو بزارید فایل `app/Providers/ZoroasterServiceProvider.php` رو باز کنید کد زیر رو در `boot` قرار دهید. 

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
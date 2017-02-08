# Laravel Admin Package

This is a simple admin package for Laravel.

## Composer

```
composer require benjamin-chen/laravel-admin-package
```

## Setting

### Add AdminServiceProvider into app config

Add AdminServiceProvider to the array of Service Providers in file config/app.php:

```
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        // ... other providers
        Illuminate\View\ViewServiceProvider::class,
        BenjaminChen\Admin\AdminServiceProvider::class,
```

### Public Assets

```
php artisan vendor:publish --tag=public
```

### Public Migrations

```
php artisan vendor:publish --tag="migrations"
```

### Public config
```
php artisan vendor:publish --tag="config"
```

### Create upload folder in public path
Create "upload" folder in your public path and change mode 777 to "upload" folder.

### Add public variable in your model class
```
public $columns = [
        'input' => [
            'name' => [
                'type' => 'text',
                'placeholder' => 'Please input your name',
            ],
            'email' => [
                'type' => 'email'
            ],
        ],
        'select' => [
            'sex' => [
                'option' => [
                    'Female' => 0,
                    'Male' => 1,
                ],
            ]
        ],
        'textarea' => [
            'blog' => [
                'rows' => 5,
            ]
        ],
        'file' => [
            'photo' => [
                'type' => 'image',
            ]
        ],
        'inputValidator' => [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'sex' => 'required',
        ]
];
```

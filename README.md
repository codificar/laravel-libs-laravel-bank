# laravel-bank

A CRUD bank library for laravel.
Uma biblioteca para CRUD de banco

## Prerequisites
- 1º: These middwares are needed:
- If your project does not have some of these middleware, it is necessary to add them.
```
auth.admin
```
- 2º: The following tables are required. The columns are the same as in the project:
```
Bank
Country
Profile
Permission
PermissionProfile
```

## Getting Started

- In root of your Laravel app in the composer.json add this code to clone the project:


```php
"repositories": [
    {
        "type": "vcs",
        "url": "https://libs:ofImhksJ@git.codificar.com.br/laravel-libs/laravel-bank.git"
    }
]
```


```
- If you want add a specific version (commit, tag or branch), so add like this:

```php

"require": {
	"codificar/bank": "1.0.4",
}

```
- Now add 

```php
"autoload": {
		//...
		"psr-4": {
			// Add your Lib here
		   "Codificar\\Bank\\": "vendor/codificar/bank/src",
			//...
		}
	},
	//...
```
- Dump the composer autoloader

```shell
composer dump-autoload -o
```

Check if has the laravel publishes in composer.json with public_vuejs_libs tag:

```
	"scripts": {
		//...
		"post-autoload-dump": [
			"@php artisan vendor:publish --tag=public_vuejs_libs --force"
			"@php artisan vendor:publish --tag=publishes_bank_tests --force"
		]
	},
```

- Next, we need to add our new Service Provider in our `config/app.php` inside the `providers` array:

```php
'providers' => [
		 ...,
			// The new package class
			Codificar\Bank\BankServiceProvider::class,
		],
```
- Migrate the database tables

```shell
php artisan migrate
```

And finally, start the application by running:

```shell
php artisan serve
```

## Admin (web)

| Type  | Return | Route  | Description |
| :------------ |:---------------: |:---------------:| :-----|
| `get` | View/html | /admin/banks | View to list all banks |
| `get` | View/html | /admin/banks/create | View to create a bank | 
| `get` | View/html | /admin/banks/update/{id} | View to update a bank |
| `get` | Api/json | /api/banks/filter | Endpoint to filter banks by id, name, code, agency_max_length,agency_digit_required, agency_digit_max_length, account_max_length, account_digit_required, account_digit_max_length, country_iso) |
| `resource` | Api/json | /api/banks | Api to get t|
| `get` | Api/json | /api/countries | Api to get the list of countries |

## Translation files route
| Type  | Return | Route  | Description |
| :------------ |:---------------: |:---------------:| :-----|
| `get` | Api/json | /libs/lang.trans/{file} | Api to get the translation files of laravel and use inside the vue.js |


# 🦅 Taz CLI for Silverstripe

[![Silverstripe Version](https://img.shields.io/badge/Silverstripe-5.1-005ae1.svg?labelColor=white&logoColor=ffffff&logo=data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDEuMDkxIDU4LjU1NSIgZmlsbD0iIzAwNWFlMSIgeG1sbnM6dj0iaHR0cHM6Ly92ZWN0YS5pby9uYW5vIj48cGF0aCBkPSJNNTAuMDE1IDUuODU4bC0yMS4yODMgMTQuOWE2LjUgNi41IDAgMCAwIDcuNDQ4IDEwLjY1NGwyMS4yODMtMTQuOWM4LjgxMy02LjE3IDIwLjk2LTQuMDI4IDI3LjEzIDQuNzg2czQuMDI4IDIwLjk2LTQuNzg1IDI3LjEzbC02LjY5MSA0LjY3NmM1LjU0MiA5LjQxOCAxOC4wNzggNS40NTUgMjMuNzczLTQuNjU0QTMyLjQ3IDMyLjQ3IDAgMCAwIDUwLjAxNSA1Ljg2MnptMS4wNTggNDYuODI3bDIxLjI4NC0xNC45YTYuNSA2LjUgMCAxIDAtNy40NDktMTAuNjUzTDQzLjYyMyA0Mi4wMjhjLTguODEzIDYuMTctMjAuOTU5IDQuMDI5LTI3LjEyOS00Ljc4NHMtNC4wMjktMjAuOTU5IDQuNzg0LTI3LjEyOWw2LjY5MS00LjY3NkMyMi40My0zLjk3NiA5Ljg5NC0uMDEzIDQuMTk4IDEwLjA5NmEzMi40NyAzMi40NyAwIDAgMCA0Ni44NzUgNDIuNTkyeiIvPjwvc3ZnPg==)](https://packagist.org/packages/goldfinch/taz)
[![Package Version](https://img.shields.io/packagist/v/goldfinch/taz.svg?labelColor=333&color=F8C630&label=Version)](https://packagist.org/packages/goldfinch/taz)
[![Total Downloads](https://img.shields.io/packagist/dt/goldfinch/taz.svg?labelColor=333&color=F8C630&label=Downloads)](https://packagist.org/packages/goldfinch/taz)
[![License](https://img.shields.io/packagist/l/goldfinch/taz.svg?labelColor=333&color=F8C630&label=License)](https://packagist.org/packages/goldfinch/taz) 

<p><img width="280" src="https://raw.githubusercontent.com/goldfinch/taz/main/taz.png" alt="Taz"></p>
<strong>Taz</strong> 🌪️ is the command line interface (CLI) that can assist you with the development of your Silverstripe application and save time.

## Install

1. Install module
```
composer require goldfinch/taz
```

2. Copy taz file to the root of your project
```bash
cp vendor/goldfinch/taz/taz taz
```

## Usage

Call Taz via console ```php taz``` 💨

#### List of available commands

```bash
php taz app:dev-build
php taz app:ss-version
php taz app:theme

php taz display:routes
php taz display:members
php taz display:admins

php taz generate:base64-key
php taz generate:crypto-key
php taz generate:password

php taz make:admin
php taz make:command
php taz make:command-template
php taz make:config
php taz make:controller
php taz make:dataextension
php taz make:extension
php taz make:form
php taz make:helper
php taz make:include
php taz make:model
php taz make:page
php taz make:page-controller
php taz make:page-template
php taz make:provider
php taz make:service
php taz make:task
php taz make:trait
php taz make:view

# Commands for external modules (each command depends on its module, make sure the module is installed in your project before using the dependent command below)

php taz make:adminconfig # jonom/silverstripe-someconfig
php taz make:block # silverstripe/silverstripe-elemental
php taz make:block-template # silverstripe/silverstripe-elemental
php taz make:crontask # silverstripe/silverstripe-crontask
php taz generate:encryption-key # lekoala/silverstripe-encrypt
```

#### Run dev/build in CLI

Runing `php taz app:dev-build` can throw MySQL errors. If this is your case, you probably need to specify the path to your MySQL socket. Here is how you can do that.

```php
// you can place it to app/_config.php

use SilverStripe\Core\Environment;
use SilverStripe\Control\Director;

if (Director::isDev() && Environment::hasEnv('SS_DATABASE_SOCKET'))
{
    ini_set('mysqli.default_socket', Environment::getEnv('SS_DATABASE_SOCKET'));
}
```

and add the var to your `.env`

```bash
SS_DATABASE_SOCKET="/path/to/mysql/mysql.sock"
```

#### Create custom commands

You can create your own custom commands for your application. They can be widely stored across separate modules.

```bash
php taz make:command MyCustom
```

## Preview

<img src="screenshots/taz.jpeg" alt="Screenshot" style="max-width: 600px">

## License

The MIT License (MIT)

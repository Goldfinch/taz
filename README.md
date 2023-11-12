<p align="center">
  <img width="300" src="https://raw.githubusercontent.com/goldfinch/taz/main/taz.png" alt="Taz">
</p>
<br/>

# Introduction

Taz is the command line interface that can assist you in building your SilverStripe application.

## Requirements

* Silverstripe CMS ^5.0
* PHP ^8.1

## Installation

1. Install the module

```bash
composer require goldfinch/taz
```


2. Copy taz file to the root of your project

```bash
cp vendor/goldfinch/taz/taz taz
```

All set. You can now call taz via console ```php taz```. See the list of available commands below.


# List of available commands

php taz app
```
app:dev-build     
app:ss-version
```

php taz generate
```
generate:base64-key
generate:crypto-key
generate:encryption-key
generate:password
```

php taz make
```
make:admin
make:adminconfig
make:block
make:block-template
make:command
make:command-template
make:config
make:controller
make:crontask
make:dataextension
make:extension
make:helper
make:include
make:model
make:page
make:page-controller
make:page-template
make:provider
make:request
make:rule
make:service
make:task
make:trait
make:view
```

# Custom commands

You can create your own custom command for your application.

```
php taz make:command MyCustom
```

Custom commands can also be stored within a module. 

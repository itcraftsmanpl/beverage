Caffeinated Beverage
====================
**Notice:** This may turn into a general support package with added functionality (mulling over creating a base repository interface for instance). The idea is that "beverage" is an ambiguous term implying that you can customize your "drink" however you like. A caffeinated beverage shares some common attributes regardless of the type of beverage you want: a cup, espresso, water, etc.

Caffeinated Beverage allows the means to easily configure the default paths of your Laravel 5.0 application. This means you can take the default Laravel framework structure:

```
laravel5/
|-- app/
|-- bootstrap/
|-- config/
|-- database/
|-- public/
|-- resources/
|-- storage/
|-- tests/
```

And configure it into something like:

```
laravel5/
|-- acme/
|-- bootstrap/
|-- system/
	|-- config/
	|-- database/
	|-- resources/
	|-- storage/
	|-- tests/
```

Installation
------------
Begin by installing the package through Composer. The best way to do this is through your terminal via Composer itself: 

```
composer require caffeinated/beverage
```

Usage
-----
First off, you'll need to use the Caffeinated Beverage Application instance in place of Laravel's Illuminate Foundation Application. Simply replace it within the `bootstrap/app.php` file like so:

```php
$app = new Caffeinated\Beverage\Application(
	realpath(__DIR__.'/../')
);
```

### Publish and Edit Config File
Simply copy the provided config file to your config path within a `caffeinated` subdirectory:

```
config/caffeinated/paths.php
```

From here, feel free to configure any paths that you'd like!

### Setting a Custom Config Path
If you'd like to also move your config directory, provide the path as the second parameter when creating a new instance of the Caffeinated Beverage Application:

```php
$app = new Caffeinated\Beverage\Application(
	realpath(__DIR__.'/../'),
	realpath(__DIR__.'/../system/config/')   // Your custom config path
);
```

### Changing The Bootstrap Path
Caffeinated Beverage does not provide the means to change your bootstrap directory path, **because** it's a simple edit you need to make within a few of your application files (don't worry, it's nothing complicated).

#### Step 1: Updating `public/index.php`
First off, you'll be wanting to change the following two `require` paths within your `public/index.php` file:

```php
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';
```

#### Step 2: Updating `bootstrap/app.php`
Secondly, open your `bootstrap/app.php` file and update the relevant path to your application base:

```php
$app = new Caffeinated\Beverage\Application(
	realpath(__DIR__.'/../')                   // Update this path
);
```

#### Step 3: Updating `bootstrap/autoload.php`
Lastly, open your `bootstrap/autoload.php` file and update both the *Composer autoload* and *compiled class* paths:

```php
/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__.'/../storage/framework/compiled.php';
```

That should be it! Simply fire up your app to verify.
# HiFramework

HiFramework is a lightweight PHP framework built to create stupid simple php applications.

  - Very Simple
  - MVC based
  - Beautiful routing system
  - Middlewares

I have to add more info on this:

> A stupidly easy and lightweight PHP framework

This is a simple php framework still in development release, we have to design a better software structure using best practices and design patterns  

### Version
Pre-alpha - 0.0.1

### Requirements

HiFramework needs zero-configuration to run properly, only PHP version to 5.5.0:

* [PHP] - PHP version > 5.5.0

### Installation

How to install ? It's too easy!

Open your favorite Terminal and run this command.

Only this:
```sh
$ git clone https://github.com/diegomariani/hiframework
```

### Usage

Very fast and simple:

```php
require 'bootstrap/autoloader.php';

$app = new Hi\Core\App();

$app->get('/welcome', function() {
    echo 'Welcome to my website with HiFramework !';
});

$app->run();
```

License
----

MIT -
**Free Software, Hell Yeah!**

[PHP]:http://php.net/


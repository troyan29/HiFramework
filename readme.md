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
Alpha - 0.0.1

### Requirements

HiFramework needs few configurations to run properly

* [PHP] - PHP version up to 5.5.0

### Installation

How to install ? It's too easy!

Open your favorite Terminal and run this command:


```sh
$ git clone https://github.com/diegomariani/hiframework
```

Or download [here](https://github.com/diegomariani/HiFramework/tarball/master)

### Usage

Very fast and simple:

```php
require 'bootstrap/autoloader.php';

$app = new Hi\Core\App();

$app->get('/welcome/$name', function($name) {
    echo "Hello $name, welcome to HiFramework !";
});

$app->run();
```

### Documentation

View full documentation [Hi Framework Docs](http://hiframework.diegomariani.com/docs)


### Official website

Visit official [Hi Framework website](http://hiframework.diegomariani.com/)

### Author

This project is maintaned by [Diego Mariani](http://diegomariani.com) under MIT licence

### Twitter

Follow the author on Twitter to get updates on HiFramework and PHP, [@hidiegomariani](https://twitter.com/hidiegomariani).

### Contribute 

Contribute to the project and getting grow togheter, fork and follow me.


License
----

MIT -
**Free Software, Hell Yeah!**

[PHP]:http://php.net/


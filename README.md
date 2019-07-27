# Cerberus

[![Build Status](https://api.travis-ci.org/devtoolboxuk/cerberus.svg?branch=master)](https://travis-ci.org/devtoolboxuk/cerberus)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/devtoolboxuk/cerberus/master.svg?style=flat)](https://scrutinizer-ci.com/g/devtoolboxuk/cerberus/?branch=master)
[![Coveralls](https://coveralls.io/repos/github/devtoolboxuk/cerberus/badge.svg?branch=master)](https://coveralls.io/github/devtoolboxuk/cerberus?branch=master)
[![CodeCov](https://img.shields.io/codecov/c/github/devtoolboxuk/cerberus.svg?style=flat&logo=codecov)](https://codecov.io/gh/devtoolboxuk/cerberus)

[![Latest Stable Version](https://img.shields.io/packagist/v/devtoolboxuk/cerberus.svg?style=flat)](https://packagist.org/packages/devtoolboxuk/cerberus)
[![Total Downloads](https://img.shields.io/packagist/dt/devtoolboxuk/cerberus.svg?style=flat)](https://packagist.org/packages/devtoolboxuk/cerberus)
[![License](https://img.shields.io/packagist/l/devtoolboxuk/cerberus.svg?style=flat)](https://packagist.org/packages/devtoolboxuk/cerberus)

[![Maintenance](https://img.shields.io/maintenance/yes/2019.svg?style=flat)](https://github.com/DevToolBoxUk)

[![PHP](https://img.shields.io/packagist/php-v/devtoolboxuk/cerberus/dev-master.svg?style=plastic)](https://github.com/DevToolBoxUk)

## Table of Contents

- [Background](#Background)
- [Usage](#Usage)
- [Help Support This Project](#Help Support This Project)

- [Maintainers](#Maintainers)
- [License](#License)

## Background

Detects if various threats are placed against the system. A score is then given to each threat. You can then decide what you want to action based on that score.

## Features

- Detects if any threats are in the string.
- Gives a score to any threats found.
- Cleans the string of any threats.

## Usage

```sh
$ composer require devtoolboxuk/cerberus
```

Then include Composer's generated vendor/autoload.php to enable autoloading:

```php
require 'vendor/autoload.php';
```

```php
use devtoolboxuk\cerberus;

$this->cerberus = new Cerberus();
```

#### Set Options
```php
$cerberus->setOptions($this->getOptions());
```

## Example - Detection of a dodgy website registration
Also see tests/test-registration.php

```php
function testDodgyRegistration()
{

    $cerberus = new CerberusService();
    $cerberus->setOptions($this->getOptions());

    $login_array = [
        'email' => 'rob@shotmail.ru',
        'name' => 'Visit my website http://www.doajob.org?redirect=https://www.google.com',
        'address' => 'Some Street',
        'postcode' => 'GL1 1AA',
        'country' => 'MX',
    ];

    $detection = $cerberus
        ->resetHandlers()
        ->pushHandler($this->createLoginStringHandler('Name', $login_array['name']))
        ->pushHandler($this->createLoginStringHandler('Address', $login_array['address']))
        ->pushHandler(new EmailHandler($login_array['email']))
        ->pushHandler(new CountryHandler($login_array['country']));

    $detection->getScore(); //Returns a Score
    $detection->getOutputByName('Name'); //Returns the cleaned sanitised output of Name;
    $detection->getResult(); //Returns a result

}

private function createLoginStringHandler($name, $data)
{
    $handler = new DefaultHandler($name, $data);
    $handler->pushWrapper(new HtmlWrapper());
    $handler->pushWrapper(new UrlWrapper());
    $handler->pushWrapper(new XssWrapper());
    return $handler;
}    

``` 

### Get References

## Get Input for each reference
```php
foreach ($detection->getReferences() as $reference)
{
    $reference->getInput();
}
```

## Get Output for each reference
```php
foreach ($detection->getReferences() as $reference)
{
    $reference->getOutPut();
}
```

## Get Output by name assigned 
- If a name is not assigned, you wont be able to look it up... duh
```php
$detection->getOutputByName('Name');
# eg: 'Visit my website'
```

## Help Support This Project

[![Help Support This Project](https://raw.githubusercontent.com/devtoolboxuk/cerberus/master/assets/buy-me-a-coffee-button.png)](https://Ko-fi.com/devtoolboxuk)

## Maintainers

[@DevToolboxUk](https://github.com/DevToolBoxUk).


## License

[MIT](LICENSE) © DevToolboxUK

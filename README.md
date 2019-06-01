# Cerberus

[![Build Status](https://api.travis-ci.org/devtoolboxuk/cerberus.svg?branch=master)](https://travis-ci.org/devtoolboxuk/cerberus)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/devtoolboxuk/cerberus/master.svg?style=flat)](https://scrutinizer-ci.com/g/devtoolboxuk/cerberus/?branch=master)
[![Coveralls](https://coveralls.io/repos/github/devtoolboxuk/cerberus/badge.svg?branch=master)](https://coveralls.io/github/devtoolboxuk/cerberus?branch=master)
[![CodeCov](https://img.shields.io/codecov/c/github/devtoolboxuk/cerberus.svg?style=flat&logo=codecov)](https://codecov.io/gh/devtoolboxuk/cerberus)

[![Latest Stable Version](https://img.shields.io/packagist/v/devtoolboxuk/cerberus.svg?style=flat)](https://packagist.org/packages/devtoolboxuk/cerberus)
[![Total Downloads](https://img.shields.io/packagist/dt/devtoolboxuk/cerberus.svg?style=flat)](https://packagist.org/packages/devtoolboxuk/cerberus)
[![License](https://img.shields.io/packagist/l/devtoolboxuk/cerberus.svg?style=flat)](https://packagist.org/packages/devtoolboxuk/cerberus)

[![License](https://img.shields.io/maintenance/yes/2019.svg?style=flat)](https://github.com/DevToolBoxUk)


## Table of Contents

- [Background](#Background)
- [Usage](#Usage)
- [Help Support This Project](#Help Support This Project)

- [Maintainers](#Maintainers)
- [License](#License)

## Background

Detects if various threats are placed against the system. A score is then given to each threat. You can then decide what you want to action based on that score

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

## Help Support This Project

[![Help Support This Project](https://raw.githubusercontent.com/devtoolboxuk/cerberus/master/assets/buy-me-a-coffee-button.png)](https://Ko-fi.com/devtoolboxuk)

## Maintainers

[@DevToolboxUk](https://github.com/DevToolBoxUk).


## License

[MIT](LICENSE) © DevToolboxUK

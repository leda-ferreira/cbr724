# PHP / CBR724 #

This package provides an experimental library for extracting information
from CBR724-formatted bank receipt files, used by Banco do Brasil.

## WARNING ##

This library is EXPERIMENTAL and WITHOUT ANY WARRANTY,
since it attempts to extract information from a proprietary,
undocumented text file format. Use it at your own risk.

## Requirements ##
* [PHP 7.0.0 or higher](http://www.php.net/)

## Installation via Composer

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require ledat/cbr724
```

## Examples ##

```php
require 'vendor/autoload.php';

$file = '/path/to/file/CBR7241212107201923225.ret';

$cbr724 = new cbr724\CBR724();
$cbr724->parseFile($file);

// some usefull metadata information...
echo $cbr724->getCompanyName(), PHP_EOL;
echo $cbr724->getBankAgency(), PHP_EOL;
echo $cbr724->getWalletNumber(), PHP_EOL;
echo $cbr724->getCreationDate()->format('d/m/Y');

// list of records
var_dump($cbr724->getListOfRecords());
```

# m'Manager Module Builder
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/myEric/mmanager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/myEric/mmanager/?branch=master)
[![Build Status](https://travis-ci.org/myEric/mmanager.svg?branch=master)](https://travis-ci.org/myEric/mmanager)
[![Latest Stable Version](https://poser.pugx.org/myeric/mmanager/v/stable.svg)](https://packagist.org/packages/myeric/mmanager) [![Total Downloads](https://poser.pugx.org/myeric/mmanager/downloads.svg)](https://travis-ci.org/myEric/mmanager)
[![Latest Unstable Version](https://poser.pugx.org/myeric/mmanager/v/unstable.svg)](https://packagist.org/packages/myeric/mmanager) [![License](https://poser.pugx.org/myeric/mmanager/license.svg)](https://packagist.org/packages/myeric/mmanager)

Official API to create modules for **[m'Manager | Invoices Management System](https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1)**

If you're using **[m'Manager | Invoices Management System](https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1)** for your buisiness and as a Web Developer, you want to extend it with your own free or Premium Modules, this package is designed to help you achieve the task with less effort.

## Requirements
* **[m'Manager | Invoices Management System](https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1) v.1.7**

## Installation
In the `composer.json` file of your **m'Manager installation**, add this line:
```
"require-dev": {
	"myeric/mmanager": "dev-master"
}
```

Then run a `composer update` on the server.

## Usage
In a controller file, add

```
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('vendor/autoload.php');
use Mmanager\Welcome as Welcome;
use Mmanager\Greetings as Greetings;

```

In your class, define a test function

```
public function test()
{
	$greetings = new Greetings('Eric Claver AKAFFOU');
	$welcome = new Welcome($greetings);
	echo $welcome->sayWelcome();
}

```

## License
MIT License


# mmanager

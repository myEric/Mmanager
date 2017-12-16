# m'Manager Module Builder
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/myEric/mmanager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/myEric/mmanager/?branch=master)
[![Build Status](https://travis-ci.org/myEric/mmanager.svg?branch=master)](https://travis-ci.org/myEric/mmanager)
[![Latest Stable Version](https://poser.pugx.org/myeric/mmanager/v/stable.svg)](https://packagist.org/packages/myeric/mmanager) [![Total Downloads](https://poser.pugx.org/myeric/mmanager/downloads.svg)](https://travis-ci.org/myEric/mmanager)
[![Latest Unstable Version](https://poser.pugx.org/myeric/mmanager/v/unstable.svg)](https://packagist.org/packages/myeric/mmanager) [![License](https://poser.pugx.org/myeric/mmanager/license.svg)](https://packagist.org/packages/myeric/mmanager)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/myEric/mmanager/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

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

Then run a `composer update` .

## Usage
In a CodeIgniter controller file, add these lines

```
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('vendor/autoload.php');
use Mmanager\Domain\Repository\CustomerRepository;
use Mmanager\Persistence\Adapter\CodeIgniter\CIQueryBuilder;

```

In your class, define a test function

```
public function test()
{
	// Create a new instance of CI Query Builder
	$driver = new CIQueryBuilder();

	// Pass CI Query Builder to Customer Repository
	$customerRepo = new CustomerRepository($driver);

	// You can now query the customers table
	$customerRepo->findAll('Customer');
}

```

## License
MIT License
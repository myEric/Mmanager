<?php
/**
 * m'Manager | Invoices Management System
 *
 * Official API to create modules for m'Manager | Invoices Management System
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017, Eric Claver AKAFFOU
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	m'Manager
 * @author	Eric Claver AKAFFOU
 * @copyright	Copyright (c) 2017, on'Eric Computing, Inc. (https://www.onericcomputing.com/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1
 * @since	Version 1.0.0
 * @filesource
 */
 
 namespace Mmanager\Domain\Repository\Customer;
 
 use Mmanager\Domain\Repository\Customer\CustomerRepositoryInterface;
 use Mmanager\Persistence\AbstractQuery;
 use Mmanager\Domain\Repository\Contract\QueryInterface;

 /**
  * Customer Repository
  */
 class CustomerRepository extends AbstractQuery implements CustomerRepositoryInterface {

 	/**
 	 * @var string
 	 */
 	protected $table = 'customer';
 	/**
 	 * @var string
 	 */
 	protected $primaryKey = 'client_id';
 	/**
 	 * @var object
 	 */
 	protected $builder;
 	/**
 	 * Customer Repository Construct
 	 * @param object $builder 
 	 * @return mixed
 	 */
 	public function __construct($builder) {
 		// Check if $builder is instance of QueryInterface
 		if ($this->isValidQueryBuilder($builder))
 			$this->builder = $builder;
 	}
 }
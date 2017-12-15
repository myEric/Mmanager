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
 */
 
 namespace Mmanager\Domain\Repository;

 use Mmanager\Domain\Repository\QueryInterface;

 /**
  * Abstract Repository Class
  */
 abstract class AbstractRepository {
 	/**
 	 * @var type object
 	 */
 	protected $query;

 	/**
 	 * Construct
 	 * @param QueryInterface $query 
 	 * @return type $this
 	 */
 	public function __construct() {
 	}
 	/**
 	 * Find Table by key
 	 * @param type $key 
 	 * @return type string
 	 */
 	public function findTableBy($key) {
 		$return = '';
		foreach ($this->_tableArray() as $k => $table) {
			if ($k === $this->_parseTableKey($key) || 
				$k.'s' === $this->_parseTableKey($key)) {
				$return = $table;
			}
		}
		return $return;
	}

	/**
	 * Helper to find all table entries
	 * @param type $table 
	 * @return type array
	 */
	private function _findAll($table) {
		return "SELECT * FROM ". $this->findTableBy($table);
	}

	/**
	 * Helper function to parse table key
	 * @param type $key 
	 * @return type string
	 */
	private function _parseTableKey($key) {
		return strtolower($key);
	}

	/**
	 * Helper function to get all table
	 * @return type array
	 */
	private function _tableArray()
	{
	    return include dirname(dirname(__DIR__)). '/Config/tables.config.php';
	}
 }
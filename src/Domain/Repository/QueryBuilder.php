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

namespace Mmanager\Domain\Repository;

use Mmanager\Domain\Repository\RepositoryInterface;
use Mmanager\Domain\Repository\QueryBuilderInterface;
use Mmanager\Persistence\CodeIgniter\Repository\CodeIgniterQueryBuilder;

class QueryBuilder implements QueryBuilderInterface, RepositoryInterface {
	/**
	 * @var object
	 */
	protected $queryBuilder;

	/**
	 * Construct
	 * @param QueryBuilderInterface $queryBuilder 
	 * @return type void
	 */
	public function __construct(QueryBuilderInterface $queryBuilder)
	{
		$this->queryBuilder = $queryBuilder;
	}

	/**
	 * Query builder
	 * @param type $query 
	 * @return type mixed
	 */
	public function query($query)
	{
		return $this->queryBuilder->query($query);
	}

	/**
	 * Get set paramas
	 * @param type $params 
	 * @return type mixed
	 */
	public function get_set($params) {
		return $this->queryBuilder->get_set($params);
	}

	/**
	 * Get a var
	 * @param type|null $query 
	 * @param type $x 
	 * @param type $y 
	 * @return type mixed
	 */
	public function get_var($query = null, $x = 0, $y = 0) {
		return $this->queryBuilder->get_var($query = null, $x = 0, $y = 0);
	}

	/**
	 * Get a single row
	 * @param type|null $query 
	 * @param type $output 
	 * @param type $y 
	 * @return type mixed
	 */
	public function get_row($query = null, $output, $y = 0) {
		return $this->queryBuilder->get_row($query = null, $output, $y = 0);
	}

	/**
	 * Get results array
	 * @param type|null $query 
	 * @param type $output 
	 * @return type mixed
	 */
	public function get_results($query = null, $output) {
		return $this->queryBuilder->get_results($query = null, $output);
	}

	/**
	 * Get col
	 * @param type|null $query 
	 * @param type $x 
	 * @return type mixed
	 */
	public function get_col($query = null, $x = 0) {
		return $this->queryBuilder->get_col($query = null, $x = 0);
	}

	/**
	 * Get col info
	 * @param type|string $info_type 
	 * @param type $col_offset 
	 * @return type mixed
	 */
	public function get_col_info($info_type = "name", $col_offset = -1) {
		return $this->queryBuilder->get_col_info($info_type = "name", $col_offset = -1);
	}
}
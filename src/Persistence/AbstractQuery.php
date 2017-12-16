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
 
 namespace Mmanager\Persistence;

 use Mmanager\Domain\Repository\Contract\QueryInterface;
 /**
  * Abstract Repository Class
  */
 abstract class AbstractQuery implements QueryInterface
 {
 	protected $table;
 	protected $primaryKey = 'id';
 	protected $returnType = 'array';
 	protected $useSoftDeletes = false;
 	protected $useTimestamps = false;
 	protected $dateFormat = 'datetime';
 	protected $createdField = 'created_at';
 	protected $updatedField = 'updated_at';
 	protected $tempUseSoftDeletes;
 	protected $deletedField = 'deleted';
 	protected $tempReturnType;
 	protected $protectFields = true;
 	protected $validationRules = [];
 	protected $validationMessages = [];
 	protected $skipValidation = false;
 	protected $beforeInsert = [];
	protected $afterInsert = [];
	protected $beforeUpdate = [];
	protected $afterUpdate = [];
	protected $afterFind = [];
	protected $afterDelete = [];
 	/**
 	 * @var object
 	 */
 	protected $builder;
 	/**
 	 * Query Builder Interface
 	 * @param object $builder 
 	 * @return mixed
 	 */
 	public function __construct(QueryInterface $builder) {

 		$this->builder = $builder;
 	}
 	public function findAll($table, $limit = null) {
 	 	return $this->query->findAll($this->findTableBy($table), $limit);
 	}
 	public function get_var($table, $var) {
 		return $this->query->get_var($this->findTableBy($table), $var);
 	}
 	/**
 	 * Find Table by key
 	 * @param string $key 
 	 * @return string
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
	 * Helper function to parse table key
	 * @param string $key 
	 * @return string
	 */
	private function _parseTableKey($key) {
		return strtolower($key);
	}

	/**
	 * Helper function to get all table
	 * @return array
	 */
	private function _tableArray() {
		return include dirname(__DIR__). '/Config/tables.config.php';
	}
 }
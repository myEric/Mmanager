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

namespace MyEric\Mmanager\Domain\Repository;

use MyEric\Mmanager\Helper\Sql\AbstractArrayHelper;
use MyEric\Mmanager\Persistence\CodeIgniter\Repository\CodeIgniterQueryBuilder as CodeIgniterQueryBuilder;
/**
 * Entity Repository Class
 */
class EntityRepository extends QueryBuilder implements EntityRepositoryInterface {

	/**
	 * @var string
	 */
	protected $_table;
	/**
	 * @var string
	 */
	protected $_primaryKey;
	/**
	 * @var string
	 */
	protected $_entityName;
	/**
	 * @var string
	 */
	protected $_class;
	/**
	 * @var object
	 */
	protected $_gateway;
	/**
	 * General Construct for custom Query Builder
	 * @param QueryBuilderInterface $gateway 
	 * @return object
	 */

	// public function __construct($entityName, QueryBuilderInterface $gateway){
	// 	$this->_gateway 	= $gateway;
	// 	$this->_entityName 	= $entityName;
	// 	$this->setEntityData($entityName);
	// }

	/**
	 * Custruct to be used for CodeIgniter Query Builder
	 * @param type $entityName 
	 * @return type mixed
	 */
	public function __construct($entityName) {
		$this->_gateway = new CodeIgniterQueryBuilder;
		$this->_entityName = $entityName;
		$this->setEntityData($entityName);
	}

	/**
	 * Set table to be used
	 * @param type $table 
	 * @return mixed
	 */
	public function setTable($table) {
		$this->_table = $table;
		return $this;
	}

	/**
	 * Get current table
	 * @return string
	 */
	public function getTable() {
		return $this->_table;
	}

	/**
	 * Set Primary Key
	 * @param type $primaryKey 
	 * @return mixed
	 */
	public function setPrimaryKey($primaryKey)
	{
		$this->_primaryKey = $primaryKey;
		return $this;
	}

	/**
	 * Get Primary Key
	 * @return mixed
	 */
	public function getPrimaryKey()
	{
		return $this->_primaryKey;
	}

	/**
	 * Set Entity Name
	 * @param type $name 
	 * @return mixed
	 */
	public function setEntityName($name) {
		$this->_entityName = $name;
		return $this;
	}

	/**
	 * Get Entity Name
	 * @return mixed
	 */
	public function getEntityName() {
		return $this->_entityName;
	}

	/**
	 * Get Class Name
	 * @return type mixed
	 */
	public function getClassName()
	{
		return $this->getEntityName();
	}

	/**
	 * Find by Id
	 * @param type $entityName 
	 * @param type $id 
	 * @return type mixed
	 */
	public function find($entityName, $id) {
		if ($this->_entityName !== $entityName) {
					throw new \RuntimeException(
				"The alias passed to the function should be ".$this->getClassName().' NOT '.$entityName
			);
		}
		return $this->_gateway->get_row("SELECT * FROM {$this->_table} WHERE $this->_primaryKey = {$id} LIMIT 1");
	}

	/**
	 * Find All
	 * @return type mixed
	 */
	public function findAll() {
		return $this->_gateway->get_results("SELECT * FROM {$this->_table}");
	}

	/**
	 * Find by specific criteria
	 * @param type $entityName 
	 * @param array $criteria 
	 * @param array|null $glue 
	 * @param array|null $orderBy 
	 * @param type|null $limit 
	 * @param type|null $offset 
	 * @return type mixed
	 */
	public function findBy($entityName, array $criteria, array $glue = null, array $orderBy = null, $limit = null, $offset = null) {
		$criteria = AbstractArrayHelper::arrayToWhereClause($criteria, $glue);

		return $this->_gateway->get_results("SELECT * FROM {$this->_table} WHERE {$criteria}");
	}

	/**
	 * Find one record by specific criteria
	 * @param type $entityName 
	 * @param array $criteria 
	 * @param array|null $orderBy 
	 * @return mixed
	 */
	public function findOneBy($entityName, array $criteria, array $orderBy = null) {
		return $this->_gateway->get_results("SELECT * FROM {$this->_table}");
	}

	/**
	 * Call
	 * @param type $method 
	 * @param type $arguments 
	 * @return type mixed
	 */
	public function __call($method, $arguments)
	{
		switch (true) {
			case (0 === strpos($method, 'findBy')):
				$by = substr($method, 6);
				$method = 'findBy';
				break;

			case (0 === strpos($method, 'findOneBy')):
				$by = substr($method, 9);
				$method = 'findOneBy';
				break;

			default:
				throw new \BadMethodCallException(
					"Undefined method '$method'. The method name must start with ".
					"either findBy or findOneBy!"
				);
		}

		if (empty($arguments)) {
			throw new \InvalidArgumentException(
				"Invalid Arguments"
			);
		}
	}

	/**
	 * Set Entity Data
	 * @param type $entityName 
	 * @return type mixed
	 */
	public function setEntityData($entityName) {
		switch ($entityName) {
			case 'Invoice':
				$this->_table = 'oc_invoices';
				$this->_primaryKey = 'id';
				break;
			case 'Customer':
				$this->_table = 'oc_clients';
				$this->_primaryKey = 'client_id';
				break;
		}
	}
	/**
	 * Display query results in a table
	 * @return type mixed
	 */
	public function debug()
	{
		return $this->_gateway->debug();
	}
}
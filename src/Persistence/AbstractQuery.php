<?php
/**
 * m'Manager | Invoices Management System
 * 
 * This content is released under the Proprietary License (Proprietary)
 *
 * Copyright (c) 2017, Eric Claver AKAFFOU - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * 
 * @package m'Manager
 * @author  Eric Claver AKAFFOU
 * @copyright   Copyright (c) 2017, on'Eric Computing, Inc. (https://www.onericcomputing.com/)
 * @license https://www.mmanager.fr  Proprietary License
 * @link    https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1
 * @since   Version 1.0.0
 * @filesource
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
 	public function __construct($builder) {
 		$this->builder = $builder;
 	}

 	public function findAll() {
 		$table = $this->findTableBy($this->table);
 		return $this->builder->db->query("SELECT * FROM {$table}")->result_object();
 	}
	public function setDate($userDate = null) {
		switch ($this->dateFormat) {
			case 'int':
				return $this->_parseDate($userDate);
			case 'datetime':
				return date('Y-m-d H:i:s', $this->_parseDate($userDate));
			case 'date':
				return date('Y-m-d', $this->_parseDate($userDate));
		}
	}
	
	public function getTable() {
		return $this->findTableBy($this->table);
	}
	public function setTable($table) {
		$this->table = $table;
		return $this;
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
	protected function _parseTableKey($key) {
		return strtolower($key);
	}

	/**
	 * Helper function to get all table
	 * @return array
	 */
	protected function _tableArray() {
		return include dirname(__DIR__). '/Config/tables.config.php';
	}
	protected function isValidQueryBuilder($builder) {
		if ( ! $builder instanceof QueryInterface) {
			throw new \InvalidArgumentException("Constructor parameter is not valid", 1);
		}
		return true;
	}
	public function query($sql, $binds = FALSE, $return_object = NULL) {
		return $this->builder->db->query($sql, $binds = FALSE, $return_object = NULL);
	}
	private function _parseDate($date) {
		return is_numeric($date) ? (int) $date : time();
	}
 }
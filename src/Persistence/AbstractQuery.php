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
 	public function find($id) {
 		return $this->builder->find($id);
 	}

 	public function findWhere($key, $value = null) {

 	}

 	public function findAll(int $limit = 0, int $offset = 0) {

 	}

 	public function first() {

 	}

 	public function save($data) {

 	}

 	public function update($id, $data) {

 	}

 	public function delete($id, $purge = false) {

 	}

 	public function deleteWhere($key, $value = null, $purge = false) {

 	}

 	public function purgeDeleted() {

 	}

 	public function asArray()
	{
		$this->tempReturnType = 'array';
		return $this;
	}

	public function asObject(string $class = 'object')
	{
		$this->tempReturnType = $class;
		return $this;
	}

	public function protect(bool $protect = true)
	{
		$this->protectFields = $protect;
		return $this;
	}

	protected function doProtectFields($data)
	{
		if ($this->protectFields === false)
		{
			return $data;
		}
		if (empty($this->allowedFields))
		{
			throw new DatabaseException('No Allowed fields specified for model: ' . get_class($this));
		}
		foreach ($data as $key => $val)
		{
			if ( ! in_array($key, $this->allowedFields))
			{
				unset($data[$key]);
			}
		}
		return $data;
	}

	protected function setDate($userData = null)
	{
		$currentDate = is_numeric($userData) ? (int) $userData : time();
		switch ($this->dateFormat)
		{
			case 'int':
				return $currentDate;
				break;
			case 'datetime':
				return date('Y-m-d H:i:s', $currentDate);
				break;
			case 'date':
				return date('Y-m-d', $currentDate);
				break;
		}
	}

	public function setTable(string $table)
	{
		$this->table = $table;
		return $this;
	}

	public function errors(bool $forceDB = false)
	{
		// Do we have validation errors?
		if ($forceDB === false && $this->skipValidation === false)
		{
			$errors = $this->validation->getErrors();
			if ( ! empty($errors))
			{
				return $errors;
			}
		}
		// Still here? Grab the database-specific error, if any.
		$error = $this->db->getError();
		return $error['message'] ?? null;
	}

	public function skipValidation(bool $skip = true)
	{
		$this->skipValidation = $skip;
		return $this;
	}

	public function validate($data): bool
	{
		if ($this->skipValidation === true || empty($this->validationRules))
		{
			return true;
		}
		// Query Builder works with objects as well as arrays,
		// but validation requires array, so cast away.
		if (is_object($data))
		{
			$data = (array) $data;
		}
		// ValidationRules can be either a string, which is the group name,
		// or an array of rules.
		if (is_string($this->validationRules))
		{
			$valid = $this->validation->run($data, $this->validationRules);
		}
		else
		{
			$this->validation->setRules($this->validationRules, $this->validationMessages);
			$valid = $this->validation->run($data);
		}
		return (bool) $valid;
	}

	public function getValidationRules(array $options=[])
	{
		$rules = $this->validationRules;
		if (isset($options['except']))
		{
			$rules = array_diff_key($rules, array_flip($options['except']));
		}
		elseif (isset($options['only']))
		{
			$rules = array_intersect_key($rules, array_flip($options['only']));
		}
		
		return $rules;
	}

	public function getValidationMessages()
	{
		return $this->validationMessages;
	}

	protected function trigger(string $event, array $data)
	{
		// Ensure it's a valid event
		if ( ! isset($this->{$event}) || empty($this->{$event}))
		{
			return $data;
		}
		foreach ($this->{$event} as $callback)
		{
			if ( ! method_exists($this, $callback))
			{
				throw new \BadMethodCallException(lang('Database.invalidEvent', [$callback]));
			}
			$data = $this->{$callback}($data);
		}
		return $data;
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
	private function _tableArray()
	{
		return include dirname(__DIR__). '/Config/tables.config.php';
	}
 }
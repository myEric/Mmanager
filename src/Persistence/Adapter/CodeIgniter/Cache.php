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
 
 namespace Mmanager\Persistence\Adapter\CodeIgniter;

 use Mmanager\Contract\CacheInterface;

 /**
  * Abstract Repository Class
  */
 class Cache implements CacheInterface {
 	protected $CI;
 	public function __construct() {
 		$this->CI = & get_instance();
 		$this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
 	}
 	public function get($key, $default = null) {
 		return $this->CI->cache->get($key);
 	}
 	public function set($key, $value, $ttl = 604800) {
 		return $this->CI->cache->save($key, $value, $ttl);
 	}
 	public function delete($key) {
 		return $this->CI->cache->delete($key);
 	}
 	public function clear() {
 		return $this->CI->cache->clean();
 	}
 	public function getMultiple($keys, $default = null) {
 		$return = [];
 		is_array($keys) OR $keys = array($keys);
 		foreach ($keys as &$value) {
 			array_push($return, $this->get($value));
 		}
 		unset($value);
 		return $return;
 	}
 	public function setMultiple($values, $ttl = 604800) {
 		$return = [];
 		is_array($keys) OR $keys = array($keys);
 		foreach ($keys as &$value) {
 			array_push($return, $this->set($value, $ttl));
 		}
 		unset($value);
 		return $return;
 	}
 	public function deleteMultiple($keys) {
 		return [];
 	}
 	public function has($key) {
 		return $this->CI->cache->get($key);
 	}
 	public function cacheInfo() {
 		return $this->CI->cache->cache_info($type = 'user');
 	}
 }
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

namespace Mmanager\Extensions\Database;
use Mmanager\Extensions\Database\ezSQL_mysqli;

class Builder {
	protected $cms;
	protected $db;
	public function __construct($cms = null) {
		$this->cms = isset($cms) ? $cms : 'app';
		$this->db = $this->__connect();
	}
	public function getConfig() {
		return include dirname(dirname(__DIR__)). '/Config/'.$this->cms.'.config.php';
	}
	private function __connect() {
		$config = $this->getConfig();
		if ( ! $config) {
			return false;
		} else {
			$username = $config['db']['username'];
			$dbpassword = $config['db']['password'];
			$dbname = $config['db']['database'];
			$host = $config['db']['host'];
			$charset = $config['db']['charset'];

			return new ezSQL_mysqli($username, $dbpassword, $dbname, $host, $charset);
		}
	}
	public function getDB() {
		return $this->db;
	}
}


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

namespace Mmanager\Extensions\Woocommerce;

use Mmanager\Extensions\Woocommerce\Functions;
/**
 * WooCommerce Entity
 */
class WooCommerce {
	protected $fn;
	public function __construct() {
		$this->fn = new Functions();
	}
	public function synched() {
		if ($this->wc_api_connect()) {
			return $this->fn->synched();
		}
	}
	public function wc_api_connect() {
		return $this->fn->wc_api_connect();
	}
	public function get($endpoint, $params = []) {
		return $this->fn->get($endpoint, $params);
	}
	public function post($endpoint, $data) {
		return $this->fn->post($endpoint, $data);
	}
	public function put($endpoint, $data) {
		return $this->fn->put($endpoint, $data);
	}
	public function delete($endpoint, $params = []) {
		return $this->fn->delete($endpoint, $params = []);
	}
	public function options($endpoint) {
		return $this->fn->options($endpoint);
	}
	public function getOptions() {
		if ($this->synched()) {
			return $this->fn->getOptions();
		}
	}
	public function getOption($option_name) {
		if ($this->synched()) {
			return $this->fn->getOption($option_name);
		}
	}
	public function getUserKeys() {
		if ($this->synched()) {
			return $this->fn->getUserKeys();
		}
	}
	public function getOrderItems($order_number) {
		if ($this->synched()) {
			return $this->fn->getOrderItems($order_number);
		}
	}
	public function getOrdersID() {
		if ($this->synched()) {
			return $this->fn->getOrdersID();
		}
	}
	public function getOrdersLogs() {
		if ($this->synched()) {
			return $this->fn->getOrdersLogs();
		}
	}
}
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
use Mmanager\Extensions\Database\Builder;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Automattic\WooCommerce\Client;

class Functions {
	protected $db;
	protected $builder;
	protected $options;
	
	public function __construct() {
		$this->builder = new Builder('woocommerce');
		$this->db = $this->builder->getDB();
		$this->options = $this->getOptions();
	}
	public function getUserKeys() {
		return array(
	    	'store_url' => $this->getOption('home'),
	    	'consumer_key' => $this->getOption('wpt_wc_api_consumer_consumer_key'),
	    	'consumer_secret' => $this->getOption('wpt_wc_api_consumer_consumer_secret')
	    );
	}
	public function get($endpoint, $params) {
		if ($this->synched()) {
			try {
			    // Array of response results.
			    $woocommerce = $this->wc_api_connect();
			    $results = $woocommerce->get($endpoint, $params);
			    // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...

			    // Last request data.
			    $lastRequest = $woocommerce->http->getRequest();
			    $lastRequest->getUrl(); // Requested URL (string).
			    $lastRequest->getMethod(); // Request method (string).
			    $lastRequest->getParameters(); // Request parameters (array).
			    $lastRequest->getHeaders(); // Request headers (array).
			    $lastRequest->getBody(); // Request body (JSON).

			    // Last response data.
			    $lastResponse = $woocommerce->http->getResponse();
			    $lastResponse->getCode(); // Response code (int).
			    $lastResponse->getHeaders(); // Response headers (array).
			    $lastResponse->getBody(); // Response body (JSON).

			    return $results;

			} catch (HttpClientException $e) {
			    $e->getMessage(); // Error message.
			    $e->getRequest(); // Last request data.
			    $e->getResponse(); // Last response data.
			}
		}
	}
	public function post($endpoint, $data) {
		if ($this->synched()) {
			$woocommerce = $this->wc_api_connect();
			return $woocommerce->post($endpoint, $data);
		}
	}
	public function put($endpoint, $data) {
		if ($this->synched()) {
			$woocommerce = $this->wc_api_connect();
			return $woocommerce->put($endpoint, $data);
		}
	}
	public function delete($endpoint, $params = []) {
		if ($this->synched()) {
			$woocommerce = $this->wc_api_connect();
			return $woocommerce->delete($endpoint, $params = []);
		}
	}
	public function options($endpoint) {
		if ($this->synched()) {
			$woocommerce = $this->wc_api_connect();
			return $woocommerce->options($endpoint);
		}
	}
	public function getOrdersID() {
		$ids = [];
		$query = "SELECT ID FROM wp_posts where post_type = 'shop_order'";
		$results = $this->db->get_results($query);
		if ($results) {
			foreach ($results as $id) {
				array_push($ids, $id->ID);
			}
		}
		return $ids;
	}
	public function getOptions() {
		$query = "SELECT * FROM wp_options";
		return $this->db->get_results($query);
	}
	public function getOption($option_name) {
		$options = $this->getOptions();
		foreach ($options as $option) {
			if ($option->option_name == $option_name) {
				return $option->option_value;
			}
		}
	}
	public function synched() {
		$options = $this->options;
		foreach ($options as $option) {
			if ($option->option_name === 'wpt_wc_mmanager_connect_sync_data' && $option->option_value == 'on') {
				return true;
			}
		}
	}
	/**
	 * Connect to the WooCommerce API.
	 *
	 * @return \Automattic\WooCommerce\Client|bool
	 */
	public function wc_api_connect() {
	    static $connection;
	 
	    if ( isset( $connection ) ) {
	        return $connection;
	    }
	 
	    $keys = $this->getUserKeys();

	    if ( ! $keys ) {
	        $connection = false;
	 
	        return $connection;
	    }
	 
	    $connection = new Client(
    		$keys['store_url'],
    		$keys['consumer_key'],
    		$keys['consumer_secret'],
    		array(
    			'wp_api'     => true,
    			'version'    => 'wc/v2',
    			'verify_ssl' => false, // Allow self-signed certificates (remove for prod)
    		)
	    );
	 
	    return $connection;
	}
}


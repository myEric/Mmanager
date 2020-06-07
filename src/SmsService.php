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

namespace Mmanager;

use Mmanager\Mmanager;
use Mmanager\Logger\FileLogger;
use Mmanager\Logger\FileLoggerFactory;
use Mmanager\Logger\StdoutLogger;
use Mmanager\Logger\StdoutLoggerFactory;

class SmsService {
	protected $platform;
  	protected $api_key;

  	public function __construct($platform = null, $api_key = null) {

		$this->platform = isset($platform) ? $platform : null;
		$this->api_key = isset($api_key) ? $api_key : null;
  	}
	/**
	 * @return mixed
	 */
	public function getPlatform()
	{
		return $this->platform;
	}

	/**
	 * @param mixed $platform
	 *
	 * @return self
	 */
	public function setPlatform($platform)
	{
		$this->platform = $platform;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getApiKey()
	{
		return $this->api_key;
	}

	/**
	 * @param mixed $api_key
	 *
	 * @return self
	 */
	public function setApiKey($api_key)
	{
		$this->api_key = $api_key;

		return $this;
	}

	public function sendMessage($phone_number, $message) {
		$platform = $this->platform;
		$api_key = $this->api_key;

		$message = urlencode($message);

		switch ($platform) {
			case 'clickatell':
				$url = "https://platform.clickatell.com/messages/http/send?apiKey=".$api_key."&to=".$phone_number."&content=".$message;
				break;
		}
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url
		));
		// Send the request & save response to $resp
		$resp = json_decode(curl_exec($curl), true);

		$log_msg = json_encode(
			array(
				'time' => date('Y-m-d h:i:sa'),
				'to' => $resp['messages'][0]['to'],
				'status' => 1 == $resp['messages'][0]['accepted'] ? "success" : "failed",
				'errorCode' => $resp['messages'][0]['errorCode'],
				'errorDescription' => $resp['messages'][0]['errorDescription']
			)
		);
		Mmanager::write_log($log_msg, "logs/sms", 'json');
		// Close request to clear up some resources
		curl_close($curl);
	}
}

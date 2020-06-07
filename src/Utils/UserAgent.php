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

namespace Mmanager\Utils;

class UserAgent
{
	protected $UserAgent;
	protected $UserIP;

	public function __construct()
	{
		$this->UserAgent = $_SERVER['HTTP_USER_AGENT'];
		$this->UserIP = $this->__getUserIP();
	}
	/**
	 * @return mixed
	 */
	public function getUserAgent()
	{
		return $this->UserAgent;
	}

	/**
	 * @param mixed $UserAgent
	 *
	 * @return self
	 */
	public function setUserAgent($UserAgent)
	{
		$this->UserAgent = $UserAgent;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUserIP()
	{
		return $this->UserIP;
	}

	/**
	 * @param mixed $UserIP
	 *
	 * @return self
	 */
	public function setUserIP($UserIP)
	{
		$this->UserIP = $UserIP;

		return $this;
	}
	private function __getUserIP()
	{
		// Get real visitor IP behind CloudFlare network
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}
}
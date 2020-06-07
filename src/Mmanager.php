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

use Mmanager\Domain\Repository\Customer\CustomerRepository;
use Mmanager\Domain\Repository\Invoice\InvoiceRepository;
use Mmanager\Persistence\Adapter\CodeIgniter\CIQueryBuilder;
use Mmanager\Logger\FileLogger;
use Mmanager\Logger\FileLoggerFactory;

class Mmanager
{
	protected $user_id;

	public function __construct() {
		$this->Customer = new CustomerRepository(new CIQueryBuilder);
		$this->Invoice = new InvoiceRepository(new CIQueryBuilder);
		$this->user_id = get_user_id();
	}
	public function setUserID($user_id = null) {
		$this->user_id = isset($user_id) ? $user_id : get_user_id();
		return $this;
	}
	public function getUserID()
	{
		return $this->user_id;
	}
	public static function getUrl($request_url) {
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $request_url);
	  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  $response = curl_exec($ch);
	  curl_close($ch);

	  return $response;
	}
	public static function isValidLicense() {
		$request_url = 'https://www.mmanager.fr/process.php?r=cl&rf='.base_url().'&pc='.get_option('purchase_code');
		return self::getUrl($request_url);
	}
	public static function expire() {
	  $validity = self::isValidLicense();
	  if ($validity == 1) {
		return '<span style="color:green">'. strtoupper(__('label_never')).'</span>';
	  } else {
		return '<span style="color:red">'.strtoupper(__('message_contact_reseller_support')).'</span>';
	  }
	}
	public static function LicenseDetails() {
		return '<p><span><strong>'. __('label_license_details'). '</strong></span><ul><li>'.__('label_domain'). rtrim(base_url(), '/').'</li><li>Status: '. is_valid_license(self::isValidLicense()).'</li><li>Expires: '. self::expire().'</li></ul></em></p>';
	}
	public static function render($module, $view_file, $data = null, $return = false) {
	  return __render($module, $view_file, $data, $return);
	}
	public static function write_log($log_msg, $folder, $extension)
	{
		if (!file_exists($folder)) 
		{
			// create directory.
			mkdir($folder, 0777, true);
		}
		$filePath = $folder.'/log-' . date('Y-m-d') . '.'.$extension;

		$loggerFactory = new FileLoggerFactory($filePath);
		$logger = $loggerFactory->createLogger();

		$logger->log($log_msg);
	}
}

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

 use Mmanager\Persistence\Adapter\CodeIgniter\CIQueryBuilder;
 use Mmanager\Contract\HelperFunctionsInterface;

 /**
  * Abstract Repository Class
  */
 class HelperFunctions extends CIQueryBuilder implements HelperFunctionsInterface
 {
 	public function getItems() {
 		return get_items();
 	}
 	public function totalRows($table) {
 		return count_total_rows($table);
 	}
 	public function totalServices() {
 		return count($this->getServices());
 	}
 	public function getServices() {
 		return get_services();
 	}
 	public function getOrders($filter) {
 		return get_sales($filter);
 	}
 	public function getCustomers($filter) {
 		return clients($filter);
 	}
 }
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

namespace Mmanager\Domain\Entity;
use Mmanager\Domain\Entity\AbstractEntity;
use Mmanager\Domain\Entity\Order;
/**
 * Customer Entity
 */
class Invoice extends AbstractEntity {
	protected $order;
	protected $invoiceDate;

	/**
	 * @return mixed
	 */
	public function getOrder()
	{
		return $this->order;
	}

	/**
	 * @param mixed $order
	 *
	 * @return self
	 */
	public function setOrder(Order $order)
	{
		$this->order = $order;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getInvoiceDate()
	{
		return $this->invoiceDate;
	}

	/**
	 * @param mixed $invoiceDate
	 *
	 * @return self
	 */
	public function setInvoiceDate($invoiceDate)
	{
		$this->invoiceDate = $invoiceDate;

		return $this;
	}
}
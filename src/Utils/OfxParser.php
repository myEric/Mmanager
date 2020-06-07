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

use Mmanager\Contract\ParserInterface;

class OfxParser implements ParserInterface
{
	public function parse($filePath)
	{
		$ofxParser = new \OfxParser\Parser();
		$ofx = $ofxParser->loadFromFile($filePath);

		$bankAccount = reset($ofx->bankAccounts);

		// Get the statement start and end dates
		$startDate = $bankAccount->statement->startDate;
		$endDate = $bankAccount->statement->endDate;

		// Get the statement transactions for the account
		return $bankAccount->statement->transactions;
	}
}

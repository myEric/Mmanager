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


class Version
{
	/**
	 * Current Mmanager Version
	 */
	const VERSION = '1.93';

	/**
	 * Compares a Mmanager version with the current one.
	 *
	 * @param string $version Mmanager version to compare.
	 *
	 * @return int Returns -1 if older, 0 if it is the same, 1 if version
	 *             passed as argument is newer.
	 */
	public static function compare($version)
	{
		$currentVersion = str_replace(' ', '', strtolower(self::VERSION));
		$version        = str_replace(' ', '', $version);

		return version_compare($version, $currentVersion);
	}
}

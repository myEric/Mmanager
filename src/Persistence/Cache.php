<?php
/**
 * m'Manager | Invoices Management System
 *
 * Official API to create modules for m'Manager | Invoices Management System
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017, Eric Claver AKAFFOU
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	m'Manager
 * @author	Eric Claver AKAFFOU
 * @copyright	Copyright (c) 2017, on'Eric Computing, Inc. (https://www.onericcomputing.com/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1
 * @since	Version 1.0.0
 * @filesource
 */
 
namespace Mmanager\Persistence;
use Mmanager\Persistence\Error;

class Cache
{
	protected $error;
	protected $cache_dir = false;
	protected $use_disk_cache = false;
	protected $cache_inserts = false;
	protected $cache_queries = false;
	protected $cache_timeout = 24; // hours
	protected $from_disk_cache = false; // hours
	protected $last_result;
	protected $col_info = null; // hours
	protected $last_query = null;

	/**********************************************************************
	*  store_cache
	*/

	public function __construct(Erro $error) {
		$this->error = $error;
	}
	public function store_cache($query, $is_insert) {

		// The would be cache file for this query
		$cache_file = $this->cache_dir.'/'.md5($query);

		// disk caching of queries
		if ($this->use_disk_cache && ($this->cache_queries && !$is_insert) || ($this->cache_inserts && $is_insert)) {
			if (!is_dir($this->cache_dir)) {
				$this->error->register_error("Could not open cache dir: $this->cache_dir");
				$this->error->show_errors ? trigger_error("Could not open cache dir: $this->cache_dir", E_USER_WARNING) : null;
			} else {
				// Cache all result values
				$result_cache = array(
					'col_info' => $this->col_info,
					'last_result' => $this->last_result,
					'num_rows' => $this->num_rows,
					'return_value' => $this->num_rows,
				);
				file_put_contents($cache_file, serialize($result_cache));
				if (file_exists($cache_file.".updating")) {
									unlink($cache_file.".updating");
				}
			}
		}

	}
	/**********************************************************************
	*  get_cache
	*/

	public function get_cache($query) {

		// The would be cache file for this query
		$cache_file = $this->cache_dir.'/'.md5($query);

		// Try to get previously cached version
		if ($this->use_disk_cache && file_exists($cache_file)) {
			// Only use this cache file if less than 'cache_timeout' (hours)
			if ((time() - filemtime($cache_file)) > ($this->cache_timeout * 3600) &&
				!(file_exists($cache_file.".updating") && (time() - filemtime($cache_file.".updating") < 60))) {
				touch($cache_file.".updating"); // Show that we in the process of updating the cache
			} else {
				$result_cache = unserialize(file_get_contents($cache_file));

				$this->col_info = $result_cache['col_info'];
				$this->last_result = $result_cache['last_result'];
				$this->num_rows = $result_cache['num_rows'];

				$this->from_disk_cache = true;

				// If debug ALL queries
				$this->trace || $this->debug_all ? $this->debug() : null;

				return $result_cache['return_value'];
			}
		}

	}
	/**********************************************************************
	*  Kill cached query results
	*/

	public function flush() {
		// Get rid of these
		$this->last_result = null;
		$this->col_info = null;
		$this->last_query = null;
		$this->from_disk_cache = false;
	}
}
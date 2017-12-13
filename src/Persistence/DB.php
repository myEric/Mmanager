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

class DB extends DBResults
{
	protected $trace            = false;  // same as $debug_all
	protected $debug_all        = false;  // same as $trace
	protected $debug_called     = false;
	protected $vardump_called   = false;
	protected $show_errors      = true;
	protected $num_queries      = 0;
	protected $conn_queries     = 0;
	protected $last_query       = null;
	protected $last_error       = null;
	protected $col_info         = null;
	protected $captured_errors  = array();
	protected $cache_dir        = false;
	protected $cache_queries    = false;
	protected $cache_inserts    = false;
	protected $use_disk_cache   = false;
	protected $cache_timeout    = 24; // hours
	protected $timers           = array();
	protected $total_query_time = 0;
	protected $db_connect_time  = 0;
	protected $trace_log        = array();
	protected $use_trace_log    = false;
	protected $sql_log_file     = false;
	protected $do_profile       = false;
	protected $profile_times    = array();
	// == TJH == default now needed for echo of debug function
	protected $debug_echo_is_on = true;
	protected $query;
	protected $from_disk_cache;
	/**********************************************************************
	*  Constructor
	*/
	public function __construct()
	{
	}
	/**********************************************************************
	*  Get host and port from an "host:port" notation.
	*  Returns array of host and port. If port is omitted, returns $default
	*/
	public function get_host_port( $host, $default = false )
	{
		$port = $default;
		if ( false !== strpos( $host, ':' ) ) {
			list( $host, $port ) = explode( ':', $host );
			$port = (int) $port;
		}
		return array( $host, $port );
	}
	/**********************************************************************
	*  Print SQL/DB error - over-ridden by specific DB class
	*/
	public function register_error($err_str)
	{
		// Keep track of last error
		$this->last_error = $err_str;
		// Capture all errors to an error array no matter what happens
		$this->captured_errors[] = array
		(
			'error_str' => $err_str,
			'query'     => $this->last_query
		);
	}
	/**********************************************************************
	*  Turn error handling on or off..
	*/
	public function show_errors()
	{
		$this->show_errors = true;
	}
	public function hide_errors()
	{
		$this->show_errors = false;
	}
	/**********************************************************************
	*  Kill cached query results
	*/
	public function flush()
	{
		// Get rid of these
		$this->last_result = null;
		$this->col_info = null;
		$this->last_query = null;
		$this->from_disk_cache = false;
	}
}
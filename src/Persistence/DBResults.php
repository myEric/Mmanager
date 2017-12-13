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

/**********************************************************************
*  Core class containg common functions to manipulate query result
*  sets once returned
*/
defined('MMANAGER_VERSION') or define('MMANAGER_VERSION', '2.0');
defined('OBJECT') or define('OBJECT', 'OBJECT');
defined('ARRAY_A') or define('ARRAY_A', 'ARRAY_A');
defined('ARRAY_N') or define('ARRAY_N', 'ARRAY_N');

class DBResults
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
}